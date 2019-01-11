<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Product\Filters;


use Henry\Domain\Product\Filters\ProductFilterInterface;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class EloquentCategoryIdFilter
 * @package Henry\Infrastructure\Product\Filters
 */
class EloquentCategoryIdFilter implements ProductFilterInterface
{
    protected $field = 'category_id';

    /**
     * @param Builder $queryBuilder
     * @param array $conditions
     * @return Builder
     */
    public function filter(Builder $queryBuilder, array $conditions = []): Builder
    {
        $categoryId = array_get($conditions, $this->field);

        if (!$categoryId) {
            return $queryBuilder;
        }

        if (!\is_array($categoryId)) {
            return $queryBuilder->where($this->field, $categoryId);
        }

        return $queryBuilder->whereIn($this->field, $categoryId);
    }
}
