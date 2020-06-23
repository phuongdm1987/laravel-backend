<?php
declare(strict_types=1);

namespace App\Policies;

use Henry\Domain\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class UserPolicy
 * @package App\Policies
 */
class UserPolicy
{
    use HandlesAuthorization;
    use VoyagerUserPolicyTrait;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $contextUser
     * @return mixed
     */
    public function viewAny(User $contextUser)
    {
        return $contextUser->hasRole(User::ROLE_SUPER_ADMIN);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $contextUser
     * @param User $user
     * @return mixed
     */
    public function view(User $contextUser, User $user)
    {
        return $contextUser->hasRole(User::ROLE_SUPER_ADMIN);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $contextUser
     * @return mixed
     */
    public function create(User $contextUser)
    {
        return $contextUser->hasRole(User::ROLE_SUPER_ADMIN);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $contextUser
     * @param User $user
     * @return mixed
     */
    public function update(User $contextUser, User $user)
    {
        return $contextUser->hasRole(User::ROLE_SUPER_ADMIN);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $contextUser
     * @param User $user
     * @return mixed
     */
    public function delete(User $contextUser, User $user)
    {
        return $contextUser->hasRole(User::ROLE_SUPER_ADMIN);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $contextUser
     * @param User $user
     * @return mixed
     */
    public function restore(User $contextUser, User $user)
    {
        return $contextUser->hasRole(User::ROLE_SUPER_ADMIN);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $contextUser
     * @param User $user
     * @return mixed
     */
    public function forceDelete(User $contextUser, User $user)
    {
        return $contextUser->hasRole(User::ROLE_SUPER_ADMIN);
    }
}
