<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Jobs\GetProductsBySearch;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class ProductController
 * @package App\Http\Controllers\Api
 */
class ProductController extends ApiController
{

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        /** @var Collection $products */
        $products = GetProductsBySearch::dispatchNow($request->get('q', ''));

        return $this->success($products->toArray());
    }
}
