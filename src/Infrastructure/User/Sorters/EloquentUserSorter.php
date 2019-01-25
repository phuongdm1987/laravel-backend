<?php
declare(strict_types=1);

namespace Henry\Infrastructure\User\Sorters;


use Henry\Domain\Product\Sorters\ProductSorterInterface;
use Henry\Domain\User\Sorters\UserSorterInterface;
use Henry\Infrastructure\AbstractEloquentSorter;

/**
 * Class EloquentUserSorter
 * @package Henry\Infrastructure\User\Sorters
 */
class EloquentUserSorter extends AbstractEloquentSorter implements UserSorterInterface
{
    /**
     * @var array
     */
    protected $fields = [];
}
