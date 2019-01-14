<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Category\Filters;


use Henry\Domain\Category\Filters\CategoryFilterInterface;
use Henry\Infrastructure\AbstractEloquentFilter;

/**
 * Class EloquentCategoryFilter
 * @package Henry\Infrastructure\Category\Filters
 */
class EloquentCategoryFilter extends AbstractEloquentFilter implements CategoryFilterInterface
{

}
