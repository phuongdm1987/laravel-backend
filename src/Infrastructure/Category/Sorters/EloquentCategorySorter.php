<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Category\Sorters;


use Henry\Domain\Category\Sorters\CategorySorterInterface;
use Henry\Infrastructure\AbstractEloquentSorter;

/**
 * Class EloquentCategorySorter
 * @package Henry\Infrastructure\Category\Sorters
 */
class EloquentCategorySorter extends AbstractEloquentSorter implements CategorySorterInterface
{
    /**
     * @var array
     */
    protected $fields = [];
}
