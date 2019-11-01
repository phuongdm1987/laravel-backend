<?php
declare(strict_types=1);

namespace Henry\Infrastructure\ProductUser\Filters;

use Henry\Domain\ProductUser\Filters\ProductUserFilterInterface;
use Henry\Infrastructure\AbstractEloquentNormalFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

/**
 * Class EloquentAttributeValueIdFilter
 * @package Henry\Infrastructure\ProductUser\Filters
 */
class EloquentAttributeValueIdFilter extends AbstractEloquentNormalFilter implements ProductUserFilterInterface
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
        parent::filter($queryBuilder, $conditions);

        $queryParam = Arr::get($conditions, $this->searchField);

        if (!$queryParam) {
            return $queryBuilder;
        }

        $field = $this->field;
        return $queryBuilder->whereHas('attributeValues', function($query) use ($field, $queryParam) {
            /** @var Builder $query */
            if (!\is_array($queryParam)) {
                return $query->where($field, $queryParam);
            }

            return $query->whereIn($field, $queryParam);
        });
    }
}
