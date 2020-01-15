<?php
declare(strict_types=1);

namespace Henry\Domain\Category\Repositories;


use Henry\Domain\Category\ValueObjects\Type;
use Henry\Domain\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface CategoryRepositoryInterface
 * @package Henry\Domain\Category\Repositories
 */
interface CategoryRepositoryInterface extends RepositoryInterface
{
    /**
     * @param Type|null $type
     * @return Collection
     * @throws \Exception
     */
    public function getAllToTree(Type $type = null): Collection;

    /**
     * @param array $data
     * @param bool $delete
     * @return int
     */
    public function rebuildTree(array $data = [], $delete = false): int;
}
