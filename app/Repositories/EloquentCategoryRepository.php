<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 04/01/2019
 * Time: 21:58
 */

namespace App\Repositories;


use App\Entities\Category;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class EloquentCategoryRepository
 * @package App\Repositories
 */
class EloquentCategoryRepository extends EloquentRepository implements CategoryRepositoryInterface
{
    /**
     * EloquentRepository constructor.
     * @param Category $model
     */
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Category
     */
    public function getModel(): Category
    {
        return new Category();
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
