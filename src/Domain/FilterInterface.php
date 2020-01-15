<?php
declare(strict_types=1);

namespace Henry\Domain;

use Illuminate\Database\Eloquent\Builder;

/**
 * Interface FilterInterface
 * @package Henry\Domain
 */
interface FilterInterface
{
    /**
     * @param Builder $queryBuilder
     * @param array $conditions
     * @return Builder
     */
    public function filter($queryBuilder, array $conditions = []): Builder;
}
