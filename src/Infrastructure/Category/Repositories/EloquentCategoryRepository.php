<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Category\Repositories;


use Henry\Domain\Category\Filters\CategoryFilterInterface;
use Henry\Infrastructure\AbstractEloquentRepository;
use Henry\Domain\Category\Category;
use Henry\Domain\Category\Repositories\CategoryRepositoryInterface;
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
     */
    public function __construct(Category $model, CategoryFilterInterface $filter)
    {
        parent::__construct($model, $filter);
    }

    /**
     * @return Collection
     */
    public function getAllMenusToTree(): Collection
    {
        return $this->model->get()->where('type', Category::TYPE_MENU)->toTree();
    }

    /**
     * @return Collection
     */
    public function getAllCategoriesToTree(): Collection
    {
        return $this->model->get()->where('type', Category::TYPE_CATEGORY)->toTree();
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
