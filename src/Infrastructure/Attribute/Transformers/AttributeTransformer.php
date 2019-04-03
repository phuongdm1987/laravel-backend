<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Attribute\Transformers;

use Henry\Domain\Attribute\Attribute;
use Henry\Infrastructure\AttributeValue\Transformers\AttributeValueTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;

/**
 * Class AttributeTransformer
 * @package Henry\Infrastructure\Attribute\Transformers
 */
class AttributeTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'attributeValues'
    ];

    /**
     * @param Attribute|null $attribute
     * @return array
     */
    public function transform(Attribute $attribute = null): array
    {
        if ($attribute === null) {
            return [];
        }

        return [
            'id' => $attribute->getId(),
            'name' => $attribute->getName(),
        ];
    }

    /**
     * @param Attribute $attribute
     * @return Collection
     */
    public function includeAttributeValues(Attribute $attribute): Collection
    {
        return $this->collection($attribute->attributeValues, new AttributeValueTransformer(), 'attributeValues');
    }
}
