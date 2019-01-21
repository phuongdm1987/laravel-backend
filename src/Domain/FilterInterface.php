<?php
declare(strict_types=1);

namespace Henry\Domain;


use Illuminate\Database\Eloquent\Builder;
use Laravel\Scout\Builder as ScoutBuilder;

/**
 * Interface FilterInterface
 * @package Henry\Domain
 */
interface FilterInterface
{
    /**
     * @param ScoutBuilder|Builder $queryBuilder
     * @param array $conditions
     * @return ScoutBuilder|Builder
     */
    public function filter($queryBuilder, array $conditions = []);
}
