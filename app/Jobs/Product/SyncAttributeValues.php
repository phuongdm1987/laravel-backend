<?php
declare(strict_types=1);

namespace App\Jobs\Product;

use Henry\Domain\Product\Product;
use Henry\Domain\Product\Repositories\ProductRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Class SyncAttributeValues
 * @package App\Jobs\Product
 */
class SyncAttributeValues implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * @var array
     */
    private $attributeValues;
    /**
     * @var int
     */
    private $productId;

    /**
     * Create a new job instance.
     *
     * @param array $attributeValues
     * @param int $productId
     */
    public function __construct(array $attributeValues, int $productId)
    {
        $this->attributeValues = $attributeValues;
        $this->productId = $productId;
    }

    /**
     * Execute the job.
     *
     * @param ProductRepositoryInterface $productRepository
     * @return void
     */
    public function handle(ProductRepositoryInterface $productRepository): void
    {
        /** @var Product $product */
        $product = $productRepository->findById($this->productId);
        $product->attributeValues()->sync($this->attributeValues);
    }
}
