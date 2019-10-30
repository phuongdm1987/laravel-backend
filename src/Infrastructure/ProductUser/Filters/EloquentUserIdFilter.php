<?php
declare(strict_types=1);

namespace Henry\Infrastructure\ProductUser\Filters;

use Henry\Domain\ProductUser\Filters\ProductUserFilterInterface;
use Henry\Infrastructure\AbstractEloquentNormalFilter;

/**
 * Class EloquentUserIdFilter
 * @package Henry\Infrastructure\ProductUser\Filters
 */
class EloquentUserIdFilter extends AbstractEloquentNormalFilter implements ProductUserFilterInterface
{
    protected $searchField = 'user_id';
    protected $field = 'user_id';
}
