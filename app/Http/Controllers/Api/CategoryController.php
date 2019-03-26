<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\UpdateCategoryRequest;
use App\Jobs\Category\GetCategoriesWithTreeFormat;
use App\Jobs\Category\GetNormalCategories;
use App\Jobs\Category\StoreCategory;
use App\Jobs\Category\UpdateCategory;
use Henry\Domain\Category\Category;
use Henry\Domain\Category\ValueObjects\Type;
use Henry\Infrastructure\Category\Transformers\CategoryTransformer;
use Henry\Infrastructure\Transformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Api
 */
class CategoryController extends ApiController
{
    /**
     * @var Transformer
     */
    private $transformer;

    /**
     * ProductController constructor.
     * @param Transformer $transformer
     */
    public function __construct(Transformer $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getAllTree(Request $request): JsonResponse
    {
        $tree = $this->dispatchNow(GetCategoriesWithTreeFormat::fromRequest($request));
        $tree = $this->transformer->transform($tree, new CategoryTransformer(), 'categories');

        return $this->success($tree);
    }

    /**
     * @return JsonResponse
     */
    public function getTypes(): JsonResponse
    {
        return $this->success(['data' => Type::getAll()]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $categories = GetNormalCategories::dispatchNow($request->all(), $request->get('per_page', 15));
        $categories = $this->transformer->transform($categories, new CategoryTransformer(), 'categories');

        return $this->success($categories);
    }

    /**
     * @param UpdateCategoryRequest $request
     * @return JsonResponse
     */
    public function store(UpdateCategoryRequest $request): JsonResponse
    {
        $product = $this->dispatchNow(StoreCategory::fromRequest($request));
        $result = $this->transformer->transform($product, new CategoryTransformer(), 'categories');

        return $this->success($result, 'Store Category Success');
    }

    /**
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return JsonResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category): JsonResponse
    {
        $request->merge(['include' => 'parent']);
        $this->dispatchNow(UpdateCategory::fromRequest($request, $category));
        $result = $this->transformer->transform($category, new CategoryTransformer(), 'categories');

        return $this->success($result, 'Update Category Success');
    }
}
