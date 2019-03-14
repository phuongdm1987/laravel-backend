<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Jobs\GetProductsBySearch;
use Henry\Infrastructure\Product\Transformers\ProductTransformer;
use Henry\Infrastructure\Transformer;
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
    public function index(Request $request): JsonResponse
    {
        /** @var Collection $products */
        $products = GetProductsBySearch::dispatchNow($request->get('q', ''));
        $products = $this->transformer->transform($products, new ProductTransformer());

        return $this->success($products);
    }
}
