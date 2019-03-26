<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Jobs\Product\GetNormalProducts;
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
        $params = $request->all();
        $params = array_merge($params, ['category_id' => $category->getId()]);
        $products = GetNormalProducts::dispatchNow($params);
        $category->load('attributes.attributeValues');

        return view('category.index', compact('category', 'products'));
    }
}
