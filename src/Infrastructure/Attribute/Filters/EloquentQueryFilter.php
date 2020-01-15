<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Attribute\Filters;


use Henry\Domain\Attribute\Filters\AttributeFilterInterface;
use Henry\Infrastructure\AbstractEloquentLikeFilter;

/**
 * Class EloquentQueryFilter
 * @package Henry\Infrastructure\Attribute\Filters
 */
class EloquentQueryFilter extends AbstractEloquentLikeFilter implements AttributeFilterInterface
{
    protected $searchField = 'q';
    protected $field = 'name';
}
