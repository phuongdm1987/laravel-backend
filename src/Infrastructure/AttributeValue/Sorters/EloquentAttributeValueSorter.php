<?php
declare(strict_types=1);

namespace Henry\Infrastructure\AttributeValue\Sorters;


use Henry\Domain\AttributeValue\Sorters\AttributeValueSorterInterface;
use Henry\Infrastructure\AbstractEloquentSorter;

/**
 * Class EloquentAttributeValueSorter
 * @package Henry\Infrastructure\AttributeValue\Sorters
 */
class EloquentAttributeValueSorter extends AbstractEloquentSorter implements AttributeValueSorterInterface
{
    /**
     * @var array
     */
    protected $fields = ['id', 'attribute_id', 'value'];
}
