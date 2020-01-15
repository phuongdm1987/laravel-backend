<?php
declare(strict_types=1);

namespace Henry\Infrastructure;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

/**
 * Class AbstractEloquentLikeFilter
 * @package Henry\Infrastructure
 */
abstract class AbstractEloquentLikeFilter
{
    protected $searchField;
    protected $field;

    /**
     * @param Builder $queryBuilder
     * @param array $conditions
     * @return Builder
     */
    public function filter($queryBuilder, array $conditions = []): Builder
    {
        $queryParam = Arr::get($conditions, $this->searchField);

        if (!$queryParam) {
            return $queryBuilder;
        }

        return $queryBuilder->where($this->field, 'like', "%{$queryParam}%");
    }
}
