<?php
declare(strict_types=1);

namespace Henry\Infrastructure\User\Repositories;


use Henry\Domain\User\Filters\UserFilterInterface;
use Henry\Domain\User\Repositories\UserRepositoryInterface;
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
     */
    public function __construct(User $model, UserFilterInterface $filter)
    {
        parent::__construct($model, $filter);
    }

    /**
     * @param string $email
     * @return Model|null
     */
    public function findByEmailAddress(string $email): ?Model
    {
        $queryBuild = $this->getModelQueryBuilder();
        $query = $this->filter->filter($queryBuild, ['email' => $email]);
        return $query->firstOrFail();
    }
}
