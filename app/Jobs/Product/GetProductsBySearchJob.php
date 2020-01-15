<?php
declare(strict_types=1);

namespace App\Jobs\Product;

use Henry\Domain\Product\Repositories\ProductRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Class GetProductsBySearchJob
 * @package App\Jobs
 */
class GetProductsBySearchJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var string
     */
    private $query;

    /**
     * GetProductsBySearchJob constructor.
     * @param string $query
     */
    public function __construct(string $query = '')
    {
        $this->query = $query;
    }

    /**
     * @param ProductRepositoryInterface $productRepository
     * @return Collection
     */
    public function handle(ProductRepositoryInterface $productRepository): Collection
    {
        return $productRepository->getTopBySearch($this->query);
    }
}
