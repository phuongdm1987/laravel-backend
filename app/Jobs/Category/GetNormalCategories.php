<?php
declare(strict_types=1);

namespace App\Jobs\Category;

use Henry\Domain\Category\Repositories\CategoryRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class GetNormalCategories
 * @package App\Jobs\Category
 */
class GetNormalCategories implements ShouldQueue
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
     * @param CategoryRepositoryInterface $categoryRepository
     * @return LengthAwarePaginator
     */
    public function handle(CategoryRepositoryInterface $categoryRepository): LengthAwarePaginator
    {
        return $categoryRepository->withPaginate($this->conditions, $this->perPage);
    }
}
