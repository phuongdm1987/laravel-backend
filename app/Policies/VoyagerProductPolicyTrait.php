<?php

namespace App\Policies;

use Henry\Domain\Product\Product;
use Henry\Domain\User\User;

trait VoyagerProductPolicyTrait
{
    /**
     * @param User $user
     * @return bool
     */
    public function browse(User $user): bool
    {
        return true;
    }

    /**
     * @param User $user
     * @param Product $product
     * @return bool
     */
    public function read(User $user, Product $product): bool
    {
        return $user->hasRole(User::ROLE_SUPER_ADMIN)
            || ($user->hasRole(User::ROLE_ADMIN)
                && $user->getId() === $product->created_by);
    }

    /**
     * @param User $user
     * @param Product $product
     * @return bool
     */
    public function edit(User $user, Product $product): bool
    {
        return $user->hasRole(User::ROLE_SUPER_ADMIN)
            || ($user->hasRole(User::ROLE_ADMIN)
                && $user->getId() === $product->created_by);
    }

    /**
     * Determine whether the user can view any products.
     *
     * @param User $user
     * @return mixed
     */
    public function add(User $user)
    {
        return true;
    }
}
