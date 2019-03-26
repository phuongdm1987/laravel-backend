<?php
declare(strict_types=1);

namespace App\Jobs\Category;

use App\Http\Requests\UpdateCategoryRequest;
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
     * Create a new job instance.
     * @param string $name
     * @param string $type
     * @param int $parentId
     */
    public function __construct(string $name, string $type, int $parentId)
    {
        $this->name = $name;
        $this->type = $type;
        $this->parentId = $parentId;
    }

    /**
     * @param UpdateCategoryRequest $request
     * @return self
     */
    public static function fromRequest(UpdateCategoryRequest $request): self
    {
        return new static($request->name(), $request->type(), $request->parentId());
    }

    /**
     * @param CategoryRepositoryInterface $categoryRepository
     * @return Model
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \Exception
     */
    public function handle(CategoryRepositoryInterface $categoryRepository): Model
    {
        cache()->deleteMultiple(['category_category', 'category_menu']);
        return $categoryRepository->create([
            'parent_id' => $this->parentId,
            'name' => $this->name,
            'type' => $this->type
        ]);
    }
}
