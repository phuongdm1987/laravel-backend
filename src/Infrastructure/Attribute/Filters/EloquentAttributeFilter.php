<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Attribute\Filters;


use Henry\Domain\Attribute\Filters\AttributeFilterInterface;
use Henry\Infrastructure\AbstractEloquentFilter;

/**
 * Class EloquentAttributeFilter
 * @package Henry\Infrastructure\Attribute\Filters
 */
class EloquentAttributeFilter extends AbstractEloquentFilter implements AttributeFilterInterface
{
    /**
     * @var array
     */
    protected $filters = [
        EloquentQueryFilter::class,
    ];
}
