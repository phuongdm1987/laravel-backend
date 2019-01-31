<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Product\Filters;


use Henry\Domain\Product\Filters\ProductFilterInterface;
use Henry\Infrastructure\AbstractEloquentFilter;

/**
 * Class EloquentProductFilter
 * @package Henry\Infrastructure\Product\Filters
 */
class EloquentProductFilter extends AbstractEloquentFilter implements ProductFilterInterface
{
    /**
     * @var array
     */
    protected $filters = [
        EloquentCategoryIdFilter::class,
        EloquentIdFilter::class,
        EloquentAttributeValueIdFilter::class,
    ];
}
