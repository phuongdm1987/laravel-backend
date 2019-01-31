<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Product\Filters;


use Henry\Domain\Product\Filters\ProductFilterInterface;
use Henry\Infrastructure\AbstractEloquentNormalFilter;

/**
 * Class EloquentIdFilter
 * @package Henry\Infrastructure\Product\Filters
 */
class EloquentIdFilter extends AbstractEloquentNormalFilter implements ProductFilterInterface
{
    protected $searchField = 'id';
    protected $field = 'id';
}
