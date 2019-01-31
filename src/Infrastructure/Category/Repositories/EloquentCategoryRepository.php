<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Category\Repositories;


use Henry\Domain\Category\Category;
use Henry\Domain\Category\Filters\CategoryFilterInterface;
use Henry\Domain\Category\Repositories\CategoryRepositoryInterface;
use Henry\Domain\Category\Sorters\CategorySorterInterface;
use Henry\Domain\Category\ValueObjects\Type;
use Henry\Infrastructure\AbstractEloquentRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class EloquentCategoryRepository
 * @package Henry\Infrastructure\Category\Repositories
 */
class EloquentCategoryRepository extends AbstractEloquentRepository implements CategoryRepositoryInterface
{
    /**
     * AbstractEloquentRepository constructor.
     * @param \Henry\Domain\Category\Category $model
     * @param CategoryFilterInterface $filter
     * @param CategorySorterInterface $sorter
     */
    public function __construct(Category $model, CategoryFilterInterface $filter, CategorySorterInterface $sorter)
    {
        parent::__construct($model, $filter, $sorter);
    }

    /**
     * @param Type $type
     * @return Collection
     * @throws \Exception
     */
    public function getAllToTree(Type $type): Collection
    {
        $this->rebuildTree();
        return cache()->remember('category_' . $type->getValue(), 15, function () use($type) {
            return $this->model
                ->where('type', $type->getValue())
                ->get()
                ->toTree();
        });
    }

    /**
     * @param array $data
     * @param bool $delete
     * @return int
     */
    public function rebuildTree(array $data = [], $delete = false): int
    {
        return $this->model->rebuildTree($data, $delete);
    }
}
