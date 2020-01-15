<?php
declare(strict_types=1);

namespace Henry\Infrastructure\AttributeValue\Filters;


use Henry\Domain\AttributeValue\Filters\AttributeValueFilterInterface;
use Henry\Infrastructure\AbstractEloquentFilter;

/**
 * Class EloquentAttributeValueFilter
 * @package Henry\Infrastructure\AttributeValue\Filters
 */
class EloquentAttributeValueFilter extends AbstractEloquentFilter implements AttributeValueFilterInterface
{
    protected $filters = [
        EloquentIdFilter::class,
        EloquentQueryFilter::class,
        EloquentAttributeIdFilter::class
    ];
}
