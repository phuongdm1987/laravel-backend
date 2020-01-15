<?php
declare(strict_types=1);

namespace App\Jobs\Category;

use Henry\Domain\Category\Repositories\CategoryRepositoryInterface;
use Henry\Domain\Category\ValueObjects\Type;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Class GetCategoriesWithTreeFormatJob
 * @package App\Jobs
 */
class GetCategoriesWithTreeFormatJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Type|null
     */
    private $type;

    /**
     * GetCategoriesWithTreeFormatJob constructor.
     * @param Type|null $type
     */
    public function __construct(Type $type = null)
    {
        $this->type = $type;
    }

    /**
     * @param Request $request
     * @return GetCategoriesWithTreeFormatJob
     */
    public static function fromRequest(Request $request): self
    {
        $type = $request->get('type', null);

        if ($type) {
            $type = new Type($type);
        }

        return new static($type);
    }

    /**
     * @param CategoryRepositoryInterface $categoryRepository
     * @return Collection
     * @throws \Exception
     */
    public function handle(CategoryRepositoryInterface $categoryRepository): Collection
    {
        return $categoryRepository->getAllToTree($this->type);
    }
}
