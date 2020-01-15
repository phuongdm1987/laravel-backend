<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\UpdateAttributeRequest;
use App\Jobs\Attribute\DeleteAttributeJob;
use App\Jobs\Attribute\GetNormalAttributesJob;
use App\Jobs\Attribute\StoreAttributeJob;
use App\Jobs\Attribute\UpdateAttributeJob;
use Henry\Domain\Attribute\Attribute;
use Henry\Infrastructure\Attribute\Transformers\AttributeTransformer;
use Henry\Infrastructure\Transformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class AttributeController
 * @package App\Http\Controllers\Api
 */
class AttributeController extends ApiController
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
        $attributes = GetNormalAttributesJob::dispatchNow($request->all(), $request->get('per_page', 15));
        $attributes = $this->transformer->transform($attributes, new AttributeTransformer(), 'attributes');

        return $this->success($attributes);
    }

    /**
     * @param UpdateAttributeRequest $request
     * @return JsonResponse
     */
    public function store(UpdateAttributeRequest $request): JsonResponse
    {
        $attribute = $this->dispatchNow(StoreAttributeJob::fromRequest($request));
        $result = $this->transformer->transform($attribute, new AttributeTransformer(), 'attributes');

        return $this->success($result, 'Store Attribute Success');
    }

    /**
     * @param UpdateAttributeRequest $request
     * @param Attribute $attribute
     * @return JsonResponse
     */
    public function update(UpdateAttributeRequest $request, Attribute $attribute): JsonResponse
    {
        $this->dispatchNow(UpdateAttributeJob::fromRequest($request, $attribute));
        $result = $this->transformer->transform($attribute, new AttributeTransformer(), 'attributes');

        return $this->success($result, 'Update Attribute Success');
    }

    /**
     * @param Attribute $attribute
     * @return JsonResponse
     */
    public function destroy(Attribute $attribute): JsonResponse
    {
        $result = DeleteAttributeJob::dispatchNow($attribute);

        if ($result) {
            return $this->success([], 'Delete Attribute Success!');
        }

        return $this->success(['status' => false], 'Delete Attribute Fail, This attribute has values!');
    }
}
