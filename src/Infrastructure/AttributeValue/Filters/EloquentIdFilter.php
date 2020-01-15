<?php
declare(strict_types=1);

namespace Henry\Infrastructure\AttributeValue\Filters;

use Henry\Domain\AttributeValue\Filters\AttributeValueFilterInterface;
use Henry\Infrastructure\AbstractEloquentNormalFilter;

/**
 * Class EloquentIdFilter
 * @package Henry\Infrastructure\AttributeValue\Filters
 */
class EloquentIdFilter extends AbstractEloquentNormalFilter implements AttributeValueFilterInterface
{
    protected $searchField = 'id';
    protected $field = 'id';
}
