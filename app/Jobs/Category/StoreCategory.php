<?php
declare(strict_types=1);

namespace App\Jobs\Category;

use App\Http\Requests\UpdateCategoryRequest;
use Henry\Domain\Category\Category;
use Henry\Domain\Category\Repositories\CategoryRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Class StoreCategory
 * @package App\Jobs\Category
 */
class StoreCategory implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $type;
    /**
     * @var int|null
     */
    private $parentId;
    /**
     * @var array
     */
    private $attributeIds;

    /**
     * Create a new job instance.
     * @param string $name
     * @param string $type
     * @param int $parentId
     * @param array $attributeIds
     */
    public function __construct(string $name, string $type, int $parentId, array $attributeIds = [])
    {
        $this->name = $name;
        $this->type = $type;
        $this->parentId = $parentId;
        $this->attributeIds = $attributeIds;
    }

    /**
     * @param UpdateCategoryRequest $request
     * @return self
     */
    public static function fromRequest(UpdateCategoryRequest $request): self
    {
        return new static($request->name(), $request->type(), $request->parentId(), $request->attributeIds());
    }

    /**
     * @param CategoryRepositoryInterface $categoryRepository
     * @return Model
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \Exception
     */
    public function handle(CategoryRepositoryInterface $categoryRepository): Model
    {
        cache()->deleteMultiple(['category_', 'category_category', 'category_menu']);
        /** @var Category $category */
        $category = $categoryRepository->create([
            'parent_id' => $this->parentId,
            'name' => $this->name,
            'type' => $this->type
        ]);

        $category->attributes()->sync($this->attributeIds);

        return $category;
    }
}
