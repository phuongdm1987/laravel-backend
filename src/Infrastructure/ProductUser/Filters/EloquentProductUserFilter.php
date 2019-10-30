<?php
declare(strict_types=1);

namespace Henry\Infrastructure\ProductUser\Filters;


use Henry\Domain\ProductUser\Filters\ProductUserFilterInterface;
use Henry\Infrastructure\AbstractEloquentFilter;

/**
 * Class EloquentProductUserFilter
 * @package Henry\Infrastructure\ProductUser\Filters
 */
class EloquentProductUserFilter extends AbstractEloquentFilter implements ProductUserFilterInterface
{
    /**
     * @var array
     */
    protected $filters = [
        EloquentProductIdFilter::class,
        EloquentProductIdFilter::class
    ];
}
