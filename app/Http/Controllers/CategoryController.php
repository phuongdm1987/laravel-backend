<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Jobs\Product\GetNormalProductsJob;
use Henry\Domain\Category\Category;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class CategoryController
 * @package App\Http\Controllers
 */
class CategoryController extends Controller
{
    /**
     * @param Request $request
     * @param Category $category
     * @return Factory|View
     */
    public function index(Request $request, Category $category)
    {
        $params = $request->all();
        $params = array_merge($params, ['category_id' => $category->getId()]);
        $products = GetNormalProductsJob::dispatchNow($params);

        return view('category.index', compact('category', 'products'));
    }
}
