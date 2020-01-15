<?php
declare(strict_types=1);

namespace Henry\Domain\User\Repositories;


use Henry\Domain\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface UserRepositoryInterface
 * @package Henry\Domain\User\Repositories
 */
interface UserRepositoryInterface extends RepositoryInterface
{
    /**
     * @param string $email
     * @return Model|null
     */
    public function findByEmailAddress(string $email): ?Model;
}
