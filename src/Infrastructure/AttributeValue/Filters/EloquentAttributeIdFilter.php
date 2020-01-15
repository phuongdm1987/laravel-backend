<?php
declare(strict_types=1);

namespace Henry\Infrastructure\AttributeValue\Filters;

use Henry\Domain\AttributeValue\Filters\AttributeValueFilterInterface;
use Henry\Infrastructure\AbstractEloquentNormalFilter;

/**
 * Class EloquentAttributeIdFilter
 * @package Henry\Infrastructure\AttributeValue\Filters
 */
class EloquentAttributeIdFilter extends AbstractEloquentNormalFilter implements AttributeValueFilterInterface
{
    protected $searchField = 'attribute_id';
    protected $field = 'attribute_id';
}
