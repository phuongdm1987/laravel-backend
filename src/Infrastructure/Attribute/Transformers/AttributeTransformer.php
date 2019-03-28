<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Attribute\Transformers;

use Henry\Domain\Attribute\Attribute;
use League\Fractal\TransformerAbstract;

/**
 * Class AttributeTransformer
 * @package Henry\Infrastructure\Attribute\Transformers
 */
class AttributeTransformer extends TransformerAbstract
{
    protected $availableIncludes = [];

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
}
