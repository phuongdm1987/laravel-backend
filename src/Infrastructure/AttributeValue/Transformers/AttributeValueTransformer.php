<?php
declare(strict_types=1);

namespace Henry\Infrastructure\AttributeValue\Transformers;

use Henry\Domain\AttributeValue\AttributeValue;
use Henry\Infrastructure\Attribute\Transformers\AttributeTransformer;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

/**
 * Class AttributeValueTransformer
 * @package Henry\Infrastructure\AttributeValue\Transformers
 */
class AttributeValueTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'attribute'
    ];

    /**
     * @param AttributeValue|null $attributeValue
     * @return array
     */
    public function transform(AttributeValue $attributeValue = null): array
    {
        if ($attributeValue === null) {
            return [];
        }
        
        return [
            'id' => $attributeValue->getId(),
            'attribute_id' => $attributeValue->getAttributeId(),
            'value' => $attributeValue->getValue(),
        ];
    }

    /**
     * @param AttributeValue $attributeValue
     * @return Item
     */
    public function includeAttribute(AttributeValue $attributeValue): Item
    {
        return $this->item($attributeValue->attribute, new AttributeTransformer(), 'attributes');
    }
}
