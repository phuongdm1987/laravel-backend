<?php
declare(strict_types=1);

namespace App\Jobs\ProductUser;

use App\Http\Requests\Product\StoreProductUserRequest;
use Henry\Domain\AttributeValue\AttributeValue;
use Henry\Domain\AttributeValue\Repositories\AttributeValueRepositoryInterface;
use Henry\Domain\ProductUser\ProductUser;
use Henry\Domain\ProductUser\Repositories\ProductUserRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Validation\ValidationException;

/**
 * Class StoreProductUserJob
 * @package App\Jobs\ProductUser
 */
class StoreProductUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var int
     */
    private $productId;
    /**
     * @var int
     */
    private $userId;
    /**
     * @var int
     */
    private $amount;
    /**
     * @var array
     */
    private $attributeValueIds;

    /**
     * StoreProductUserJob constructor.
     * @param int $productId
     * @param int $userId
     * @param int $amount
     * @param array $attributeValueIds
     */
    public function __construct(int $productId, int $userId, int $amount, array $attributeValueIds = [])
    {
        $this->productId = $productId;
        $this->userId = $userId;
        $this->amount = $amount;
        $this->attributeValueIds = $attributeValueIds;
    }

    /**
     * @param \App\Http\Requests\Product\StoreProductUserRequest $request
     * @return self
     */
    public static function fromRequest(StoreProductUserRequest $request): self
    {
        return new static(
            $request->productId(),
            $request->userId(),
            $request->amount(),
            $request->attributeValueIds()
        );
    }

    /**
     * @param ProductUserRepositoryInterface $productUserRepository
     * @param AttributeValueRepositoryInterface $attributeValueRepository
     * @return Model
     */
    public function handle(
        ProductUserRepositoryInterface $productUserRepository,
        AttributeValueRepositoryInterface $attributeValueRepository): Model {

        $conditions = [
            'product_id' => $this->productId,
            'user_id' => $this->userId,
            'attribute_value_id' => $this->attributeValueIds
        ];
        if ($productUserRepository->findBy($conditions)) {
            throw ValidationException::withMessages([
                'product_id' => [__('validation.unique', ['attribute' => 'product_id'])],
            ]);
        }

        /** @var ProductUser $productUser */
        $productUser = $productUserRepository->create([
            'product_id' => $this->productId,
            'user_id' => $this->userId,
            'amount' => $this->amount,
        ]);

        $this->syncAttributeValues($attributeValueRepository, $productUser);

        return $productUser;
    }

    /**
     * @param AttributeValueRepositoryInterface $attributeValueRepository
     * @param ProductUser $productUser
     */
    private function syncAttributeValues(
        AttributeValueRepositoryInterface $attributeValueRepository,
        ProductUser $productUser
    ): void {
        $attributeValues = $attributeValueRepository->all(['id' => $this->attributeValueIds]);
        $attributeValueIds = [];
        foreach ($attributeValues as $attributeValue) {
            /** @var AttributeValue $attributeValue */
            $attributeValueIds[$attributeValue->getId()] = ['attribute_id' => $attributeValue->getAttributeId()];
        }

        $productUser->attributeValues()->sync($attributeValueIds);
    }
}
