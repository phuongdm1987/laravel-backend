<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Jobs\GetProductsBySearch;
use Henry\Application\Http\JsonResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class ProductController
 * @package App\Http\Controllers\Api
 */
class ProductController extends Controller
{
    use JsonResponseTrait;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $products = GetProductsBySearch::dispatchNow($request->all());

        return $this->getSuccess($products->toArray());
    }
}
