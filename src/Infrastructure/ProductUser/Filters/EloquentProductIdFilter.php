<?php
declare(strict_types=1);

namespace Henry\Infrastructure\ProductUser\Filters;

use Henry\Domain\ProductUser\Filters\ProductUserFilterInterface;
use Henry\Infrastructure\AbstractEloquentNormalFilter;

/**
 * Class EloquentProductIdFilter
 * @package Henry\Infrastructure\ProductUser\Filters
 */
class EloquentProductIdFilter extends AbstractEloquentNormalFilter implements ProductUserFilterInterface
{
    protected $searchField = 'product_id';
    protected $field = 'product_id';
}
