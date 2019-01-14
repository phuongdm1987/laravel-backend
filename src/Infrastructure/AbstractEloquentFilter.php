<?php
declare(strict_types=1);

namespace Henry\Infrastructure;


use Henry\Domain\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class AbstractEloquentFilter
 * @package Henry\Infrastructure
 */
abstract class AbstractEloquentFilter
{
    protected $filters = [];

    /**
     * @param Builder $queryBuilder
     * @param array $conditions
     * @return Builder
     */
    public function filter(Builder $queryBuilder, array $conditions = []): Builder
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
