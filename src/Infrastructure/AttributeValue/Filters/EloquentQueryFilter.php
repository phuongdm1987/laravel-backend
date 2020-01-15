<?php
declare(strict_types=1);

namespace Henry\Infrastructure\AttributeValue\Filters;


use Henry\Domain\AttributeValue\Filters\AttributeValueFilterInterface;
use Henry\Infrastructure\AbstractEloquentLikeFilter;

/**
 * Class EloquentQueryFilter
 * @package Henry\Infrastructure\AttributeValue\Filters
 */
class EloquentQueryFilter extends AbstractEloquentLikeFilter implements AttributeValueFilterInterface
{
    protected $searchField = 'q';
    protected $field = 'value';
}
