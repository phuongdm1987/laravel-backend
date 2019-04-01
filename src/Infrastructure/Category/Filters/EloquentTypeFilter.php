<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Category\Filters;

use Henry\Domain\Category\Filters\CategoryFilterInterface;
use Henry\Infrastructure\AbstractEloquentNormalFilter;

/**
 * Class EloquentTypeFilter
 * @package Henry\Infrastructure\Category\Filters
 */
class EloquentTypeFilter extends AbstractEloquentNormalFilter implements CategoryFilterInterface
{
    protected $searchField = 'type';
    protected $field = 'type';
}
