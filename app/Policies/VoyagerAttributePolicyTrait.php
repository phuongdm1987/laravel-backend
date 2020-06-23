<?php
declare(strict_types=1);

namespace App\Policies;

use Henry\Domain\Attribute\Attribute;
use Henry\Domain\User\User;

/**
 * Trait VoyagerAttributePolicyTrait
 * @package App\Policies
 */
trait VoyagerAttributePolicyTrait
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
     * @param Attribute $attribute
     * @return bool
     */
    public function read(User $user, Attribute $attribute): bool
    {
        return $user->hasRole(User::ROLE_SUPER_ADMIN)
            || ($user->hasRole(User::ROLE_ADMIN)
                && $user->getId() === $attribute->created_by);
    }

    /**
     * @param User $user
     * @param Attribute $attribute
     * @return bool
     */
    public function edit(User $user, Attribute $attribute): bool
    {
        return $user->hasRole(User::ROLE_SUPER_ADMIN)
            || ($user->hasRole(User::ROLE_ADMIN)
                && $user->getId() === $attribute->created_by);
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
