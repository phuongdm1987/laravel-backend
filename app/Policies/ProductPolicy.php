<?php
declare(strict_types=1);

namespace App\Policies;

use Henry\Domain\Product\Product;
use Henry\Domain\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class ProductPolicy
 * @package App\Policies
 */
class ProductPolicy
{
    use HandlesAuthorization;
    use VoyagerProductPolicyTrait;

    /**
     * Determine whether the user can view any products.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the product.
     *
     * @param User $user
     * @param Product $product
     * @return mixed
     */
    public function view(User $user, Product $product)
    {
        return $user->hasRole(User::ROLE_SUPER_ADMIN)
            || ($user->hasRole(User::ROLE_ADMIN)
                && $user->getId() === $product->created_by);
    }

    /**
     * Determine whether the user can create products.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the product.
     *
     * @param User $user
     * @param Product $product
     * @return mixed
     */
    public function update(User $user, Product $product)
    {
        return $user->hasRole(User::ROLE_SUPER_ADMIN)
            || ($user->hasRole(User::ROLE_ADMIN)
                && $user->getId() === $product->created_by);
    }

    /**
     * Determine whether the user can delete the product.
     *
     * @param User $user
     * @param Product $product
     * @return mixed
     */
    public function delete(User $user, Product $product)
    {
        return $user->hasRole(User::ROLE_SUPER_ADMIN);
    }

    /**
     * Determine whether the user can restore the product.
     *
     * @param User $user
     * @param Product $product
     * @return mixed
     */
    public function restore(User $user, Product $product)
    {
        return $user->hasRole(User::ROLE_SUPER_ADMIN);
    }

    /**
     * Determine whether the user can permanently delete the product.
     *
     * @param User $user
     * @param Product $product
     * @return mixed
     */
    public function forceDelete(User $user, Product $product)
    {
        return $user->hasRole(User::ROLE_SUPER_ADMIN);
    }
}
