<?php
declare(strict_types=1);

namespace Henry\Infrastructure\ProductUser\Sorters;


use Henry\Domain\ProductUser\Sorters\ProductUserSorterInterface;
use Henry\Infrastructure\AbstractEloquentSorter;

/**
 * Class EloquentProductUserSorter
 * @package Henry\Infrastructure\ProductUser\Sorters
 */
class EloquentProductUserSorter extends AbstractEloquentSorter implements ProductUserSorterInterface
{
    /**
     * @var array
     */
    protected $fields = ['id', 'user_id'];
}
