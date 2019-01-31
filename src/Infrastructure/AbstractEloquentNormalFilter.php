<?php
declare(strict_types=1);

namespace Henry\Infrastructure;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class AbstractEloquentNormalFilter
 * @package Henry\Infrastructure
 */
abstract class AbstractEloquentNormalFilter
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
        $queryParam = array_get($conditions, $this->searchField);

        if (!$queryParam) {
            return $queryBuilder;
        }

        if (!\is_array($queryParam)) {
            return $queryBuilder->where($this->field, $queryParam);
        }

        return $queryBuilder->whereIn($this->field, $queryParam);
    }
}
