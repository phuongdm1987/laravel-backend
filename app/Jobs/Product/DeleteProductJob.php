<?php
declare(strict_types=1);

namespace App\Jobs\Product;

use Henry\Domain\Product\Product;
use Henry\Domain\Product\Repositories\ProductRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class DeleteProductJob
 * @package App\Jobs\Product
 */
class DeleteProductJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var Product
     */
    private $product;

    /**
     * Create a new job instance.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @param ProductRepositoryInterface $productRepository
     * @throws \Exception
     */
    public function handle(ProductRepositoryInterface $productRepository): void
    {
        $this->product->attributeValues()->detach();
        $productRepository->delete($this->product);
    }
}
