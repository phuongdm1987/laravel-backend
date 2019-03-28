<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;


use App\Http\Requests\UpdateAttributeValueRequest;
use App\Jobs\AttributeValue\DeleteAttributeValue;
use App\Jobs\AttributeValue\GetNormalAttributeValues;
use App\Jobs\AttributeValue\StoreAttributeValue;
use App\Jobs\AttributeValue\UpdateAttributeValue;
use Henry\Domain\AttributeValue\AttributeValue;
use Henry\Infrastructure\AttributeValue\Transformers\AttributeValueTransformer;
use Henry\Infrastructure\Transformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class AttributeValueController
 * @package App\Http\Controllers\Api
 */
class AttributeValueController extends ApiController
{
    /**
     * @var Transformer
     */
    private $transformer;

    /**
     * ProductController constructor.
     * @param Transformer $transformer
     */
    public function __construct(Transformer $transformer)
    {
        $this->transformer = $transformer;
    }
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $attributeValues = GetNormalAttributeValues::dispatchNow($request->all(), $request->get('per_page', 15));
        $attributeValues = $this->transformer->transform($attributeValues, new AttributeValueTransformer(), 'attributeValues');

        return $this->success($attributeValues);
    }

    /**
     * @param UpdateAttributeValueRequest $request
     * @return JsonResponse
     */
    public function store(UpdateAttributeValueRequest $request): JsonResponse
    {
        $attribute = $this->dispatchNow(StoreAttributeValue::fromRequest($request));
        $result = $this->transformer->transform($attribute, new AttributeValueTransformer(), 'attributeValues');

        return $this->success($result, 'Store AttributeValue Success');
    }

    /**
     * @param UpdateAttributeValueRequest $request
     * @param AttributeValue $attribute
     * @return JsonResponse
     */
    public function update(UpdateAttributeValueRequest $request, AttributeValue $attribute): JsonResponse
    {
        $this->dispatchNow(UpdateAttributeValue::fromRequest($request, $attribute));
        $result = $this->transformer->transform($attribute, new AttributeValueTransformer(), 'attributeValues');

        return $this->success($result, 'Update AttributeValue Success');
    }

    /**
     * @param AttributeValue $attribute
     * @return JsonResponse
     */
    public function destroy(AttributeValue $attribute): JsonResponse
    {
        DeleteAttributeValue::dispatchNow($attribute);

        return $this->success([], 'Delete AttributeValue Success!');
    }
}
