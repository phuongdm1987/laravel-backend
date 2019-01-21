<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Jobs\GetProductsByCategory;
use App\Jobs\GetProductsByCategoryId;
use Henry\Domain\Category\Category;
use Henry\Domain\Product\Repositories\ProductRepositoryInterface;
use Illuminate\Http\Request;

/**
 * Class CategoryController
 * @package App\Http\Controllers
 */
class CategoryController extends Controller
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * CategoryController constructor.
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param Request $request
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, Category $category)
    {
        $products = GetProductsByCategory::dispatchNow($category, $request->all());

        return view('category.index', compact('category', 'products'));
    }
}
