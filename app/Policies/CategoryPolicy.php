<?php
declare(strict_types=1);

namespace App\Policies;

use Henry\Domain\Category\Category;
use Henry\Domain\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class CategoryPolicy
 * @package App\Policies
 */
class CategoryPolicy
{
    use HandlesAuthorization;
    use VoyagerCategoryPolicyTrait;

    /**
     * Determine whether the user can view any categories.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the category.
     *
     * @param User $user
     * @param Category $category
     * @return mixed
     */
    public function view(User $user, Category $category)
    {
        return $user->hasRole(User::ROLE_SUPER_ADMIN)
            || ($user->hasRole(User::ROLE_ADMIN)
                && $user->getId() === $category->created_by);
    }

    /**
     * Determine whether the user can create categories.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the category.
     *
     * @param User $user
     * @param Category $category
     * @return mixed
     */
    public function update(User $user, Category $category)
    {
        return $user->hasRole(User::ROLE_SUPER_ADMIN)
            || ($user->hasRole(User::ROLE_ADMIN)
                && $user->getId() === $category->created_by);
    }

    /**
     * Determine whether the user can delete the category.
     *
     * @param User $user
     * @param Category $category
     * @return mixed
     */
    public function delete(User $user, Category $category)
    {
        return $user->hasRole(User::ROLE_SUPER_ADMIN);
    }

    /**
     * Determine whether the user can restore the category.
     *
     * @param User $user
     * @param Category $category
     * @return mixed
     */
    public function restore(User $user, Category $category)
    {
        return $user->hasRole(User::ROLE_SUPER_ADMIN);
    }

    /**
     * Determine whether the user can permanently delete the category.
     *
     * @param User $user
     * @param Category $category
     * @return mixed
     */
    public function forceDelete(User $user, Category $category)
    {
        return $user->hasRole(User::ROLE_SUPER_ADMIN);
    }
}
