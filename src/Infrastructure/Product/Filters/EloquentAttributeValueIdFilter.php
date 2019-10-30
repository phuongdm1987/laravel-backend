<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Product\Filters;

use Henry\Domain\Product\Filters\ProductFilterInterface;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class EloquentAttributeValueIdFilter
 * @package Henry\Infrastructure\Product\Filters
 */
class EloquentAttributeValueIdFilter implements ProductFilterInterface
{
    protected $searchField = 'attribute_value_id';
    protected $field = 'attribute_value_id';

    /**
     * @param Builder $queryBuilder
     * @param array $conditions
     * @return Builder
     */
    public function filter($queryBuilder, array $conditions = []): Builder
    {
        $field = $this->field;
        $attributeValueId = array_get($conditions, $this->searchField);

        if (!$attributeValueId) {
            return $queryBuilder;
        }

        return $queryBuilder->whereHas('attributeValues', function ($query) use($attributeValueId, $field) {
            if (!\is_array($attributeValueId)) {
                return $query->where($field, $attributeValueId);
            }

            return $query->whereIn($this->field, $attributeValueId);
        });
    }
}
