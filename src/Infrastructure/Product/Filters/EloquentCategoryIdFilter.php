<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Product\Filters;

use Henry\Domain\Product\Filters\ProductFilterInterface;
use Henry\Infrastructure\AbstractEloquentNormalFilter;

/**
 * Class EloquentCategoryIdFilter
 * @package Henry\Infrastructure\Product\Filters
 */
class EloquentCategoryIdFilter extends AbstractEloquentNormalFilter implements ProductFilterInterface
{
    protected $searchField = 'category_id';
    protected $field = 'category_id';
}
