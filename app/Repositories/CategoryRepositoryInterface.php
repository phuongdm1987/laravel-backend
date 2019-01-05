<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 04/01/2019
 * Time: 21:57
 */

namespace App\Repositories;


use Illuminate\Database\Eloquent\Collection;

/**
 * Interface CategoryRepositoryInterface
 * @package App\Repositories
 */
interface CategoryRepositoryInterface extends RepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAllMenusToTree(): Collection;

    /**
     * @return Collection
     */
    public function getAllCategoriesToTree(): Collection;

    /**
     * @param array $data
     * @param bool $delete
     * @return int
     */
    public function rebuildTree(array $data = [], $delete = false): int;
}
