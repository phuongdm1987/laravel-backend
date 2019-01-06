<?php
declare(strict_types=1);

namespace Henry\Domain\Category\Repositories;


use Illuminate\Database\Eloquent\Collection;
use Henry\Domain\RepositoryInterface;

/**
 * Interface CategoryRepositoryInterface
 * @package Henry\Domain\Category\Repositories
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
