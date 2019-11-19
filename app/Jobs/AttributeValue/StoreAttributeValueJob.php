<?php
declare(strict_types=1);

namespace App\Jobs\AttributeValue;

use App\Http\Requests\UpdateAttributeValueRequest;
use Henry\Domain\AttributeValue\Repositories\AttributeValueRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class StoreAttributeValueJob
 * @package App\Jobs\AttributeValue
 */
class StoreAttributeValueJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var int
     */
    private $attributeId;
    /**
     * @var string
     */
    private $value;

    /**
     * StoreAttributeValueJob constructor.
     * @param int $attributeId
     * @param string $value
     */
    public function __construct(int $attributeId, string $value)
    {
        $this->attributeId = $attributeId;
        $this->value = $value;
    }

    /**
     * @param UpdateAttributeValueRequest $request
     * @return self
     */
    public static function fromRequest(UpdateAttributeValueRequest $request): self
    {
        return new static($request->attributeId(), $request->value());
    }

    /**
     * @param AttributeValueRepositoryInterface $attributeValueRepository
     * @return Model
     */
    public function handle(AttributeValueRepositoryInterface $attributeValueRepository): Model
    {
        return $attributeValueRepository->create([
            'attribute_id' => $this->attributeId,
            'value' => $this->value
        ]);
    }
}
