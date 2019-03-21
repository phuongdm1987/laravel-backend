<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\UpdateProductRequest;
use App\Jobs\Product\DeleteProduct;
use App\Jobs\Product\GetNormalProducts;
use App\Jobs\Product\UpdateProduct;
use Henry\Domain\Product\Product;
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
        $products = GetNormalProducts::dispatchNow($request->all());
        $products = $this->transformer->transform($products, new ProductTransformer(), 'products');

        return $this->success($products);
    }

    /**
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        $request->merge(['include' => 'category']);
        $this->dispatchNow(UpdateProduct::fromRequest($request, $product));
        $result = $this->transformer->transform($product->load('category'), new ProductTransformer(), 'products');

        return $this->success($result, 'Update Product Success');
    }

    /**
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        DeleteProduct::dispatchNow($product);
        return $this->success(['msg' => 'Delete product success!']);
    }
}
