<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Henry\Domain\Category\Category;
use Henry\Domain\Product\Repositories\ProductRepositoryInterface;

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
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Category $category)
    {
        $products = $this->productRepository->getPaginateByCategoryId($category->getId());

        return view('category.index', compact('category', 'products'));
    }
}
