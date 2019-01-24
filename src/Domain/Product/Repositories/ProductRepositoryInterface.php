<?php
declare(strict_types=1);

namespace Henry\Domain\Product\Repositories;


use Henry\Domain\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface ProductRepositoryInterface
 * @package Henry\Domain\Product\Repositories
 */
interface ProductRepositoryInterface extends RepositoryInterface
{
    /**
     * @param array $conditions
     * @return Collection
     */
    public function getTopBySearch(array $conditions = []): Collection;
}
