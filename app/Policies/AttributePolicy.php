<?php
declare(strict_types=1);

namespace App\Policies;

use Henry\Domain\Attribute\Attribute;
use Henry\Domain\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class AttributePolicy
 * @package App\Policies
 */
class AttributePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any attributes.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the attribute.
     *
     * @param User $user
     * @param Attribute $attribute
     * @return mixed
     */
    public function view(User $user, Attribute $attribute)
    {
        return $user->getProfile()->isSuperAdmin()
            || ($user->getProfile()->isAdmin()
                && $user->getId() === $attribute->getCreatedById());
    }

    /**
     * Determine whether the user can create attributes.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the attribute.
     *
     * @param User $user
     * @param Attribute $attribute
     * @return mixed
     */
    public function update(User $user, Attribute $attribute)
    {
        return $user->getProfile()->isSuperAdmin()
            || ($user->getProfile()->isAdmin()
                && $user->getId() === $attribute->getCreatedById());
    }

    /**
     * Determine whether the user can delete the attribute.
     *
     * @param User $user
     * @param Attribute $attribute
     * @return mixed
     */
    public function delete(User $user, Attribute $attribute)
    {
        return $user->getProfile()->isSuperAdmin();
    }

    /**
     * Determine whether the user can restore the attribute.
     *
     * @param User $user
     * @param Attribute $attribute
     * @return mixed
     */
    public function restore(User $user, Attribute $attribute)
    {
        return $user->getProfile()->isSuperAdmin();
    }

    /**
     * Determine whether the user can permanently delete the attribute.
     *
     * @param User $user
     * @param Attribute $attribute
     * @return mixed
     */
    public function forceDelete(User $user, Attribute $attribute)
    {
        return $user->getProfile()->isSuperAdmin();
    }
}
