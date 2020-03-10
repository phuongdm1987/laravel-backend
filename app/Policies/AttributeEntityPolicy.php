<?php
declare(strict_types=1);

namespace App\Policies;

use Henry\Domain\AttributeEntity\AttributeEntity;
use Henry\Domain\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class AttributeEntityPolicy
 * @package App\Policies
 */
class AttributeEntityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any attribute entities.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the attribute entity.
     *
     * @param User $user
     * @param AttributeEntity $attributeEntity
     * @return mixed
     */
    public function view(User $user, AttributeEntity $attributeEntity)
    {
        return $user->getProfile()->isSuperAdmin()
            || ($user->getProfile()->isAdmin()
                && $user->getId() === $attributeEntity->getCreatedById());
    }

    /**
     * Determine whether the user can create attribute entities.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the attribute entity.
     *
     * @param User $user
     * @param AttributeEntity $attributeEntity
     * @return mixed
     */
    public function update(User $user, AttributeEntity $attributeEntity)
    {
        return $user->getProfile()->isSuperAdmin()
            || ($user->getProfile()->isAdmin()
                && $user->getId() === $attributeEntity->getCreatedById());
    }

    /**
     * Determine whether the user can delete the attribute entity.
     *
     * @param User $user
     * @param AttributeEntity $attributeEntity
     * @return mixed
     */
    public function delete(User $user, AttributeEntity $attributeEntity)
    {
        return $user->getProfile()->isSuperAdmin();
    }

    /**
     * Determine whether the user can restore the attribute entity.
     *
     * @param User $user
     * @param AttributeEntity $attributeEntity
     * @return mixed
     */
    public function restore(User $user, AttributeEntity $attributeEntity)
    {
        return $user->getProfile()->isSuperAdmin();
    }

    /**
     * Determine whether the user can permanently delete the attribute entity.
     *
     * @param User $user
     * @param AttributeEntity $attributeEntity
     * @return mixed
     */
    public function forceDelete(User $user, AttributeEntity $attributeEntity)
    {
        return $user->getProfile()->isSuperAdmin();
    }
}
