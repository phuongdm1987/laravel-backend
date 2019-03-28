<?php
declare(strict_types=1);

namespace App\Jobs\AttributeValue;

use Henry\Domain\AttributeValue\AttributeValue;
use Henry\Domain\AttributeValue\Repositories\AttributeValueRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class UpdateAttributeValue
 * @package App\Jobs\AttributeValue
 */
class UpdateAttributeValue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var array
     */
    private $attributes;
    /**
     * @var AttributeValue
     */
    private $attributeValue;

    /**
     * Create a new job instance.
     * @param array $attributes
     * @param AttributeValue $attributeValue
     */
    public function __construct(array $attributes, AttributeValue $attributeValue)
    {
        $this->attributes = $attributes;
        $this->attributeValue = $attributeValue;
    }

    /**
     * @param AttributeValueRepositoryInterface $attributeValueRepository
     */
    public function handle(AttributeValueRepositoryInterface $attributeValueRepository): void
    {
        $attributeValueRepository->update($this->attributes, $this->attributeValue);
    }
}
