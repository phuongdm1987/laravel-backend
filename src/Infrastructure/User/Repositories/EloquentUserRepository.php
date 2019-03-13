<?php
declare(strict_types=1);

namespace Henry\Infrastructure\User\Repositories;


use Henry\Domain\User\Filters\UserFilterInterface;
use Henry\Domain\User\Repositories\UserRepositoryInterface;
use Henry\Domain\User\Sorters\UserSorterInterface;
use Henry\Domain\User\User;
use Henry\Infrastructure\AbstractEloquentRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EloquentUserRepository
 * @package Henry\Infrastructure\User\Repositories
 */
class EloquentUserRepository extends AbstractEloquentRepository implements UserRepositoryInterface
{
    /**
     * EloquentUserRepository constructor.
     * @param User $model
     * @param UserFilterInterface $filter
     * @param UserSorterInterface $sorter
     */
    public function __construct(User $model, UserFilterInterface $filter, UserSorterInterface $sorter)
    {
        parent::__construct($model, $filter, $sorter);
    }

    /**
     * @param string $email
     * @return Model|null
     */
    public function findByEmailAddress(string $email): ?Model
    {
        $query = $this->generateQueryBuilder(['email' => $email]);
        return $query->firstOrFail();
    }
}
