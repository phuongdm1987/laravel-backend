<?php
declare(strict_types=1);

namespace App\Jobs\Category;

use Henry\Domain\Category\Category;
use Henry\Domain\Category\Repositories\CategoryRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class DeleteCategoryJob
 * @package App\Jobs\Category
 */
class DeleteCategoryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var Category
     */
    private $category;

    /**
     * Create a new job instance.
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @param CategoryRepositoryInterface $categoryRepository
     * @return bool
     * @throws \Exception
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function handle(CategoryRepositoryInterface $categoryRepository): bool
    {
        if (!$this->category->products->isEmpty()) {
            return false;
        }
        cache()->deleteMultiple(['category_', 'category_category', 'category_menu']);
        $this->category->attributes()->detach();
        $categoryRepository->delete($this->category);

        return true;
    }
}
