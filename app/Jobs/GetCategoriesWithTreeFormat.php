<?php
declare(strict_types=1);

namespace App\Jobs;

use Henry\Domain\Category\Repositories\CategoryRepositoryInterface;
use Henry\Domain\Category\ValueObjects\Type\Type;
use Henry\Domain\Category\ValueObjects\Type\TypeException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Class GetCategoriesWithTreeFormat
 * @package App\Jobs
 */
class GetCategoriesWithTreeFormat implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Type
     */
    private $type;

    /**
     * GetCategoriesWithTreeFormat constructor.
     * @param Type $type
     */
    public function __construct(Type $type)
    {
        $this->type = $type;
    }

    /**
     * @param Request $request
     * @return GetCategoriesWithTreeFormat
     * @throws TypeException
     */
    public static function fromRequest(Request $request): self
    {
        $type = new Type();
        $type->setType($request->get('type', Type::TYPE_MENU));

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
