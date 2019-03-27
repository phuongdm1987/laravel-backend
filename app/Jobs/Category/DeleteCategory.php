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
 * Class DeleteCategory
 * @package App\Jobs\Category
 */
class DeleteCategory implements ShouldQueue
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
     */
    public function handle(CategoryRepositoryInterface $categoryRepository): bool
    {
        if (!$this->category->products->isEmpty()) {
            return false;
        }

        $this->category->attributes()->delete();
        $categoryRepository->delete($this->category);

        return true;
    }
}
