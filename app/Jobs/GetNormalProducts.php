<?php
declare(strict_types=1);

namespace App\Jobs;

use Henry\Domain\Product\Repositories\ProductRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class GetNormalProducts
 * @package App\Jobs
 */
class GetNormalProducts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var array
     */
    private $conditions;
    /**
     * @var int
     */
    private $perPage;

    /**
     * Create a new job instance.
     * @param array $conditions
     * @param int $perPage
     */
    public function __construct(array $conditions = [], $perPage = 15)
    {
        $this->conditions = $conditions;
        $this->perPage = $perPage;
    }

    /**
     * Execute the job.
     * @param ProductRepositoryInterface $productRepository
     * @return LengthAwarePaginator
     */
    public function handle(ProductRepositoryInterface $productRepository): LengthAwarePaginator
    {
        return $productRepository->withPaginate($this->conditions, $this->perPage);
    }
}
