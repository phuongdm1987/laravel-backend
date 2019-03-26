<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Category\Filters;


use Henry\Domain\Category\Filters\CategoryFilterInterface;
use Henry\Infrastructure\AbstractEloquentLikeFilter;

/**
 * Class EloquentQueryFilter
 * @package Henry\Infrastructure\Category\Filters
 */
class EloquentQueryFilter extends AbstractEloquentLikeFilter implements CategoryFilterInterface
{
    protected $searchField = 'q';
    protected $field = 'name';
}
