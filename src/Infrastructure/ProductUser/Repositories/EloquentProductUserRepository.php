<?php
declare(strict_types=1);

namespace Henry\Infrastructure\ProductUser\Repositories;


use Henry\Domain\ProductUser\Filters\ProductUserFilterInterface;
use Henry\Domain\ProductUser\ProductUser;
use Henry\Domain\ProductUser\Repositories\ProductUserRepositoryInterface;
use Henry\Domain\ProductUser\Sorters\ProductUserSorterInterface;
use Henry\Infrastructure\AbstractEloquentRepository;

/**
 * Class EloquentProductUserRepository
 * @package Henry\Infrastructure\ProductUser\Repositories
 */
class EloquentProductUserRepository extends AbstractEloquentRepository implements ProductUserRepositoryInterface
{
    /**
     * AbstractEloquentRepository constructor.
     * @param ProductUser $model
     * @param ProductUserFilterInterface $filter
     * @param ProductUserSorterInterface $sorter
     */
    public function __construct(
        ProductUser $model,
        ProductUserFilterInterface $filter,
        ProductUserSorterInterface $sorter
    ) {
        parent::__construct($model, $filter, $sorter);
    }
}
