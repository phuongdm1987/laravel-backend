<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Category\Transformers;

use Henry\Domain\Category\Category;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

/**
 * Class CategoryTransformer
 * @package Henry\Infrastructure\Category\Transformers
 */
class CategoryTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'parent'
    ];

    /**
     * @param Category $category
     * @return array
     */
    public function transform(Category $category): array
    {
        return [
            'id' => $category->getId(),
            'name' => $category->getName(),
            'slug' => $category->getSlug(),
            'type' => $category->getType()->getValue(),
            'parent_id' => $category->getParentId(),
        ];
    }

    /**
     * @param Category $category
     * @return Item
     */
    public function includeParent(Category $category): Item
    {
        return $this->item($category->parent, new self, 'categories');
    }
}
