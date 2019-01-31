<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Jobs\GetProductsByCategory;
use Henry\Domain\Category\Category;
use Illuminate\Http\Request;

/**
 * Class CategoryController
 * @package App\Http\Controllers
 */
class CategoryController extends Controller
{
    /**
     * @param Request $request
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, Category $category)
    {
        $products = GetProductsByCategory::dispatchNow($category, $request->all());
        $category->load('attributes.attributeValues');

        return view('category.index', compact('category', 'products'));
    }
}
