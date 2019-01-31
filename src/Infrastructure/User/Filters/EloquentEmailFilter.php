<?php
declare(strict_types=1);

namespace Henry\Infrastructure\User\Filters;

use Henry\Domain\Product\Filters\ProductFilterInterface;
use Henry\Infrastructure\AbstractEloquentNormalFilter;

/**
 * Class EloquentEmailFilter
 * @package Henry\Infrastructure\User\Filters
 */
class EloquentEmailFilter extends AbstractEloquentNormalFilter implements ProductFilterInterface
{
    protected $searchField = 'email';
    protected $field = 'email';
}
