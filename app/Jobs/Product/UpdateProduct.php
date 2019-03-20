<?php
declare(strict_types=1);

namespace App\Jobs\Product;

use App\Http\Requests\UpdateProductRequest;
use Henry\Domain\Product\Product;
use Henry\Domain\Product\Repositories\ProductRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class UpdateProduct
 * @package App\Jobs\Product
 */
class UpdateProduct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var array
     */
    private $attributes;
    /**
     * @var Product
     */
    private $product;
    /**
     * Create a new job instance.
     * @param array $attributes
     * @param Product $product
     */
    public function __construct(array $attributes, Product $product)
    {
        $this->attributes = $attributes;
        $this->product = $product;
    }

    /**
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return UpdateProduct
     */
    public static function fromRequest(UpdateProductRequest $request, Product $product): UpdateProduct
    {
        return new static(
            [
                'category_id' => $request->categoryId(),
                'name' => $request->name(),
                'description' => $request->description()
            ],
            $product
        );
    }

    /**
     * Execute the job.
     * @param ProductRepositoryInterface $productRepository
     */
    public function handle(ProductRepositoryInterface $productRepository): void
    {
        $productRepository->update($this->attributes, $this->product);
    }
}
