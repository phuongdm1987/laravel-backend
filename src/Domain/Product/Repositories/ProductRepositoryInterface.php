<?php
declare(strict_types=1);

namespace Henry\Domain\Product\Repositories;


use Henry\Domain\RepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface ProductRepositoryInterface
 * @package Henry\Domain\Product\Repositories
 */
interface ProductRepositoryInterface extends RepositoryInterface
{
    /**
     * @param int $categoryId
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPaginateByCategoryId(int $categoryId, $perPage = 15): LengthAwarePaginator;
}
