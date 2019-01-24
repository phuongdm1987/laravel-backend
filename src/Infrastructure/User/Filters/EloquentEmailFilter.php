<?php
declare(strict_types=1);

namespace Henry\Infrastructure\User\Filters;


use Henry\Domain\Product\Filters\ProductFilterInterface;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Scout\Builder as ScoutBuilder;

/**
 * Class EloquentEmailFilter
 * @package Henry\Infrastructure\User\Filters
 */
class EloquentEmailFilter implements ProductFilterInterface
{
    protected $field = 'email';

    /**
     * @param ScoutBuilder|Builder $queryBuilder
     * @param array $conditions
     * @return ScoutBuilder|Builder
     */
    public function filter($queryBuilder, array $conditions = [])
    {
        $email = array_get($conditions, $this->field);

        if (!$email) {
            return $queryBuilder;
        }

        return $queryBuilder->where($this->field, $email);
    }
}
