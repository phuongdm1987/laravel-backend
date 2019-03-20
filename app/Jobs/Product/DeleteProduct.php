<?php
declare(strict_types=1);

namespace App\Jobs\Product;

use Henry\Domain\Product\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class DeleteProduct
 * @package App\Jobs\Product
 */
class DeleteProduct implements ShouldQueue
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
     * @throws \Exception
     */
    public function handle(): void
    {
        $this->product->attributeValues()->delete();
        $this->product->delete();
    }
}
