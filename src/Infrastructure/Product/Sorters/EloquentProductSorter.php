<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Product\Sorters;


use Henry\Domain\Product\Sorters\ProductSorterInterface;
use Henry\Infrastructure\AbstractEloquentSorter;

/**
 * Class EloquentProductSorter
 * @package Henry\Infrastructure\Product\Sorters
 */
class EloquentProductSorter extends AbstractEloquentSorter implements ProductSorterInterface
{
    /**
     * @var array
     */
    protected $fields = ['id', 'category_id', 'name', 'amount'];
}
