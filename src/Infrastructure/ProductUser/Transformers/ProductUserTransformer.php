<?php
declare(strict_types=1);

namespace Henry\Infrastructure\ProductUser\Transformers;

use Henry\Domain\Product\Product;
use Henry\Domain\ProductUser\ProductUser;
use Henry\Infrastructure\AttributeValue\Transformers\AttributeValueTransformer;
use Henry\Infrastructure\Product\Transformers\ProductTransformer;
use Henry\Infrastructure\User\Transformers\UserTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

/**
 * Class ProductUserTransformer
 * @package Henry\Infrastructure\ProductUser\Transformers
 */
class ProductUserTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'product',
        'user',
        'attributeValues'
    ];

    /**
     * @param ProductUser|null $productUser
     * @return array
     */
    public function transform(ProductUser $productUser = null): array
    {
        if ($productUser === null) {
            return [];
        }

        return [
            'id' => $productUser->getId(),
            'product_id' => $productUser->getProductId(),
            'user_id' => $productUser->getUserId()
        ];
    }

    /**
     * @param ProductUser $productUser
     * @return Item
     */
    public function includeProduct(ProductUser $productUser): Item
    {
        return $this->item($productUser->product, new ProductTransformer, 'products');
    }

    /**
     * @param ProductUser $productUser
     * @return Item
     */
    public function includeUser(ProductUser $productUser): Item
    {
        return $this->item($productUser->user, new UserTransformer, 'users');
    }

    /**
     * @param Product $productUser
     * @return Collection
     */
    public function includeAttributeValues(Product $productUser): Collection
    {
        return $this->collection($productUser->attributeValues, new AttributeValueTransformer(), 'attributeValues');
    }
}
