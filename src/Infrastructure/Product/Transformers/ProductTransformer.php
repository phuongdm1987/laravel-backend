<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Product\Transformers;

use Henry\Domain\Product\Product;
use Henry\Infrastructure\Category\Transformers\CategoryTransformer;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

/**
 * Class ProductTransformer
 * @package Henry\Infrastructure\Product\Transformers
 */
class ProductTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'category'
    ];

    /**
     * @param Product|null $product
     * @return array
     */
    public function transform(Product $product = null): array
    {
        if ($product === null) {
            return [];
        }

        $currency = $product->getAmount();

        return [
            'id' => $product->getId(),
            'name' => $product->getName(),
            'slug' => $product->getSlug(),
            'category_id' => $product->getCategoryId(),
            'description' => $product->getDescription(),
            'amount' => $currency->getValue(),
            'amount_format' => $currency->format()
        ];
    }

    /**
     * @param Product $product
     * @return Item
     */
    public function includeCategory(Product $product): Item
    {
        return $this->item($product->category, new CategoryTransformer, 'categories');
    }
}
