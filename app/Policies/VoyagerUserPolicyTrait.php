<?php

namespace App\Policies;

use Henry\Domain\Product\Product;
use Henry\Domain\User\User;

trait VoyagerUserPolicyTrait
{
    /**
     * @param User $contextUser
     * @return bool
     */
    public function browse(User $contextUser): bool
    {
        return true;
    }

    /**
     * @param User $contextUser
     * @param User $user
     * @return bool
     */
    public function read(User $contextUser, User $user): bool
    {
        return $contextUser->hasRole(User::ROLE_SUPER_ADMIN);
    }

    /**
     * @param User $contextUser
     * @param User $user
     * @return bool
     */
    public function edit(User $contextUser, User $user): bool
    {
        return $contextUser->hasRole(User::ROLE_SUPER_ADMIN);
    }

    /**
     * Determine whether the user can view any products.
     *
     * @param User $contextUser
     * @return mixed
     */
    public function add(User $contextUser)
    {
        return true;
    }
}
