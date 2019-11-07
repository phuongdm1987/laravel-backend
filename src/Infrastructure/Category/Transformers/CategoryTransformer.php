<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Category\Transformers;

use Henry\Domain\Category\Category;
use Henry\Infrastructure\Attribute\Transformers\AttributeTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

/**
 * Class CategoryTransformer
 * @package Henry\Infrastructure\Category\Transformers
 */
class CategoryTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'parent',
        'children',
        'attributes'
    ];

    /**
     * @param Category|null $category
     * @return array
     */
    public function transform(Category $category = null): array
    {
        if ($category === null) {
            return [];
        }
        
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

    /**
     * @param Category $category
     * @return Collection
     */
    public function includeChildren(Category $category): Collection
    {
        return $this->collection($category->children, new self, 'categories');
    }

    /**
     * @param Category $category
     * @return Collection|\League\Fractal\Resource\NullResource
     */
    public function includeAttributes(Category $category)
    {
        if ($category === null) {
            return $this->null();
        }
        return $this->collection($category->attributes->sortBy('id'), new AttributeTransformer(), 'attributes');
    }
}
