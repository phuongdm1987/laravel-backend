<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Product\Filters;


use Henry\Domain\Product\Filters\ProductFilterInterface;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Scout\Builder as ScoutBuilder;

/**
 * Class EloquentIdFilter
 * @package Henry\Infrastructure\Product\Filters
 */
class EloquentIdFilter implements ProductFilterInterface
{
    protected $field = 'id';

    /**
     * @param ScoutBuilder|Builder $queryBuilder
     * @param array $conditions
     * @return ScoutBuilder|Builder
     */
    public function filter($queryBuilder, array $conditions = [])
    {
        $id = array_get($conditions, $this->field);

        if (!$id) {
            return $queryBuilder;
        }

        if (!\is_array($id)) {
            return $queryBuilder->where($this->field, $id);
        }

        return $queryBuilder->whereIn($this->field, $id);
    }
}
