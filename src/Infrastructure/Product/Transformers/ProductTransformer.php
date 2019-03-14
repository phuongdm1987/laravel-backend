<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Product\Transformers;

use Henry\Domain\Product\Product;
use League\Fractal\TransformerAbstract;

/**
 * Class ProductTransformer
 * @package Henry\Infrastructure\Product\Transformers
 */
class ProductTransformer extends TransformerAbstract
{
    /**
     * @param Product $product
     * @return array
     */
    public function transform(Product $product): array
    {
        return [
            'id' => $product->getId(),
            'name' => $product->getName(),
            'slug' => $product->getSlug(),
            'category_id' => $product->getCategoryId(),
            'description' => $product->getDescription(),
            'amount' => $product->getAmount()->getValue()
        ];
    }
}
