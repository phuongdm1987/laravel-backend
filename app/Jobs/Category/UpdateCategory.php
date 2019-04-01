<?php
declare(strict_types=1);

namespace App\Jobs\Category;

use App\Http\Requests\UpdateCategoryRequest;
use Henry\Domain\Category\Category;
use Henry\Domain\Category\Repositories\CategoryRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class UpdateCategory
 * @package App\Jobs\Category
 */
class UpdateCategory implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var array
     */
    private $attributes;
    /**
     * @var Category
     */
    private $category;

    /**
     * Create a new job instance.
     * @param array $attributes
     * @param Category $category
     */
    public function __construct(array $attributes, Category $category)
    {
        $this->attributes = $attributes;
        $this->category = $category;
    }

    /**
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return self
     */
    public static function fromRequest(UpdateCategoryRequest $request, Category $category): self
    {
        return new static(
            [
                'parent_id' => $request->parentId(),
                'name' => $request->name(),
                'type' => $request->type(),
                'attribute_ids' => $request->attributeIds()
            ],
            $category
        );
    }

    /**
     * @param CategoryRepositoryInterface $categoryRepository
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function handle(CategoryRepositoryInterface $categoryRepository): void
    {
        cache()->deleteMultiple(['category_', 'category_category', 'category_menu']);
        $categoryRepository->update($this->attributes, $this->category);

        if (array_has($this->attributes, 'attribute_ids')) {
            $this->category->attributes()->sync($this->attributes['attribute_ids']);
        }
    }
}
