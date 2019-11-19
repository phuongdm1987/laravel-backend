<?php
declare(strict_types=1);

namespace Henry\Infrastructure\User\Transformers;

use Henry\Domain\Product\Product;
use Henry\Domain\ProductUser\ProductUser;
use Henry\Domain\User\User;
use Henry\Infrastructure\AttributeValue\Transformers\AttributeValueTransformer;
use Henry\Infrastructure\Category\Transformers\CategoryTransformer;
use Henry\Infrastructure\Product\Transformers\ProductTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

/**
 * Class UserTransformer
 * @package Henry\Infrastructure\User\Transformers
 */
class UserTransformer extends TransformerAbstract
{
    protected $availableIncludes = [

    ];

    /**
     * @param User|null $user
     * @return array
     */
    public function transform(User $user = null): array
    {
        if ($user === null) {
            return [];
        }

        return [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'verified_at' => $user->getVerifiedAt() ? $user->getVerifiedAt()->format('d-m-Y') : null,
            'created_at' => $user->getCreatedAt()->format('d-m-Y'),
            'updated_at' => $user->getUpdatedAt()->format('d-m-Y'),
        ];
    }
}
