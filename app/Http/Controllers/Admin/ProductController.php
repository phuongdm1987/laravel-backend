<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Product\GetAttributesRequest;
use App\Jobs\Product\SyncAttributeValues;
use Henry\Domain\Category\Repositories\CategoryRepositoryInterface;
use Henry\Domain\Product\Product;
use Henry\Domain\Product\Repositories\ProductRepositoryInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Facades\Voyager;

/**
 * Class ProductController
 * @package App\Http\Controllers\Admin
 */
class ProductController extends AbstractVoyagerController
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;

    /**
     * ProductController constructor.
     * @param ProductRepositoryInterface $productRepository
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        CategoryRepositoryInterface $categoryRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param Request $request
     * @param $id
     * @return View
     * @throws AuthorizationException
     */
    public function show(Request $request, $id): View
    {
        $voyagerReader = $this->getReadInfo($request, $id);

        /** @var Product $product */
        $product = $this->productRepository->findById($id);
        $attributes = $product->category->attributes;
        $attributeValues = $product->attributeValues->pluck('id')->toArray();

        return Voyager::view(
            $voyagerReader->getView(),
            array_merge(
                [
                    'dataType' => $voyagerReader->getDataType(),
                    'dataTypeContent' => $voyagerReader->getDataTypeContent(),
                    'isModelTranslatable' => $voyagerReader->isModelTranslatable(),
                    'isSoftDeleted' => $voyagerReader->isSoftDeleted(),
                ],
                compact(
                    'attributes',
                    'attributeValues',
                    'product'
                )
            )
        );
    }

    /**
     * @param Request $request
     * @param $id
     * @return View
     * @throws AuthorizationException
     */
    public function edit(Request $request, $id): View
    {
        $voyagerEditor = $this->getEditInfo($request, $id);

        /** @var Product $product */
        $product = $this->productRepository->findById($id);
        $attributes = $product->category->attributes;
        $attributeValues = $product->attributeValues->pluck('id')->toArray();

        return Voyager::view(
            $voyagerEditor->getView(),
            array_merge(
                [
                    'dataType' => $voyagerEditor->getDataType(),
                    'dataTypeContent' => $voyagerEditor->getDataTypeContent(),
                    'isModelTranslatable' => $voyagerEditor->isModelTranslatable(),
                ],
                compact(
                    'attributes',
                    'attributeValues',
                    'product'
                )
            )
        );
    }

    // POST BR(E)AD
    public function update(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Compatibility with Model binding.
        $id = $id instanceof \Illuminate\Database\Eloquent\Model ? $id->{$id->getKeyName()} : $id;

        $model = app($dataType->model_name);
        if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope'.ucfirst($dataType->scope))) {
            $model = $model->{$dataType->scope}();
        }
        if ($model && in_array(SoftDeletes::class, class_uses_recursive($model))) {
            $data = $model->withTrashed()->findOrFail($id);
        } else {
            $data = $model->findOrFail($id);
        }

        // Check permission
        $this->authorize('edit', $data);

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->editRows, $dataType->name, $id)->validate();
        $this->insertUpdateData($request, $slug, $dataType->editRows, $data);

        event(new BreadDataUpdated($dataType, $data));

        $this->dispatchNow(new SyncAttributeValues($request->get('attribute_value', []), (int)$id));

        if (auth()->user()->can('browse', app($dataType->model_name))) {
            $redirect = redirect()->route("voyager.{$dataType->slug}.index");
        } else {
            $redirect = redirect()->back();
        }

        return $redirect->with([
            'message'    => __('voyager::generic.successfully_updated')." {$dataType->getTranslatedAttribute('display_name_singular')}",
            'alert-type' => 'success',
        ]);
    }

    /**
     * @param Request $request
     * @return View
     * @throws AuthorizationException
     */
    public function create(Request $request): View
    {
        $voyagerCreator = $this->getCreateInfo($request);

        return Voyager::view(
            $voyagerCreator->getView(),
            [
                'dataType' => $voyagerCreator->getDataType(),
                'dataTypeContent' => $voyagerCreator->getDataTypeContent(),
                'isModelTranslatable' => $voyagerCreator->isModelTranslatable(),
                'attributes' => [],
                'attributeValues' => [],
                'product' => null,
            ]
        );
    }

    /**
     * @param GetAttributesRequest $request
     * @return View
     */
    public function getAttributesByCategoryId(GetAttributesRequest $request)
    {
        $category = $this->categoryRepository->findById($request->categoryId());
        $attributes = $category->attributes;

        if ($request->productId() <= 0) {
            $attributeValues = [];
        } else {
            /** @var Product $product */
            $product = $this->productRepository->findById($request->productId());
            $attributeValues = $product->attributeValues->pluck('id')->toArray();
        }

        return view(
            'vendor.voyager.products.attributes-edit',
            compact(
                'attributes',
                'attributeValues'
            )
        );
    }
}
