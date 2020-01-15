<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Attribute\Sorters;


use Henry\Domain\Attribute\Sorters\AttributeSorterInterface;
use Henry\Infrastructure\AbstractEloquentSorter;

/**
 * Class EloquentAttributeSorter
 * @package Henry\Infrastructure\Attribute\Sorters
 */
class EloquentAttributeSorter extends AbstractEloquentSorter implements AttributeSorterInterface
{
    /**
     * @var array
     */
    protected $fields = ['id', 'name', 'is_filter'];
}
