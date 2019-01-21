<?php
declare(strict_types=1);

namespace Henry\Infrastructure;


use Henry\Domain\FilterInterface;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Scout\Builder as ScoutBuilder;

/**
 * Class AbstractEloquentFilter
 * @package Henry\Infrastructure
 */
abstract class AbstractEloquentFilter
{
    protected $filters = [];

    /**
     * @param ScoutBuilder|Builder $queryBuilder
     * @param array $conditions
     * @return ScoutBuilder|Builder
     */
    public function filter($queryBuilder, array $conditions = [])
    {
        if (!$conditions) {
            return $queryBuilder;
        }

        foreach ($this->filters as $filter) {
            /** @var FilterInterface $filter */
            $queryBuilder = app($filter)->filter($queryBuilder, $conditions);
        }

        return $queryBuilder;
    }
}
