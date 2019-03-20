<?php
declare(strict_types=1);

namespace App\Jobs\Product;

use Henry\Domain\Category\Category;
use Henry\Domain\Product\Repositories\ProductRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Class GetProductsByCategory
 * @package App\Jobs
 */
class GetProductsByCategory implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var Category
     */
    private $category;
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
     * @param Category $category
     * @param array $conditions
     * @param int $perPage
     */
    public function __construct(Category $category, array $conditions = [], $perPage = 15)
    {
        $this->category = $category;
        $this->conditions = $conditions;
        $this->perPage = $perPage;
    }

    /**
     * @param ProductRepositoryInterface $productRepository
     * @return LengthAwarePaginator
     */
    public function handle(ProductRepositoryInterface $productRepository): LengthAwarePaginator
    {
        $params = array_merge($this->conditions, ['category_id' => $this->category->getId()]);

        return $productRepository->withPaginate($params, $this->perPage);
    }
}
