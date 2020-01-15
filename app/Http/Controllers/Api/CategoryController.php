<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\UpdateCategoryRequest;
use App\Jobs\Category\DeleteCategoryJob;
use App\Jobs\Category\GetCategoriesWithTreeFormatJob;
use App\Jobs\Category\GetNormalCategoriesJob;
use App\Jobs\Category\StoreCategoryJob;
use App\Jobs\Category\UpdateCategoryJob;
use Henry\Domain\Category\Category;
use Henry\Domain\Category\Repositories\CategoryRepositoryInterface;
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
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;

    /**
     * ProductController constructor.
     * @param Transformer $transformer
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(Transformer $transformer, CategoryRepositoryInterface $categoryRepository)
    {
        $this->transformer = $transformer;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getAllTree(Request $request): JsonResponse
    {
        $tree = $this->dispatchNow(GetCategoriesWithTreeFormatJob::fromRequest($request));
        $tree->load('children.children.children.children.children', 'attributes');
        $tree = $this->transformer->transform($tree, new CategoryTransformer(), 'categories');

        return $this->success($tree);
    }

    public function show($id)
    {
        $category = $this->categoryRepository->findById($id);
        $category = $this->transformer->transform($category, new CategoryTransformer(), 'categories');

        return $this->success($category);
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
        $categories = GetNormalCategoriesJob::dispatchNow($request->all(), $request->get('per_page', 15));
        $categories = $this->transformer->transform($categories, new CategoryTransformer(), 'categories');

        return $this->success($categories);
    }

    /**
     * @param UpdateCategoryRequest $request
     * @return JsonResponse
     */
    public function store(UpdateCategoryRequest $request): JsonResponse
    {
        $category = $this->dispatchNow(StoreCategoryJob::fromRequest($request));
        $result = $this->transformer->transform($category, new CategoryTransformer(), 'categories');

        return $this->success($result, 'Store Category Success');
    }

    /**
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return JsonResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category): JsonResponse
    {
        $request->merge(['include' => 'parent,attributes']);
        $this->dispatchNow(UpdateCategoryJob::fromRequest($request, $category));
        $result = $this->transformer->transform($category, new CategoryTransformer(), 'categories');

        return $this->success($result, 'Update Category Success');
    }

    /**
     * @param Category $category
     * @return JsonResponse
     */
    public function destroy(Category $category): JsonResponse
    {
        $result = DeleteCategoryJob::dispatchNow($category);

        if ($result) {
            return $this->success([], 'Delete Category Success!');
        }

        return $this->success(['status' => false], 'Delete Category Fail, This category has categorys!');
    }
}
