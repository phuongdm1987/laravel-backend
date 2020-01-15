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
 * Class DeleteAttributeValueJob
 * @package App\Jobs\AttributeValue
 */
class DeleteAttributeValueJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var AttributeValue
     */
    private $attributeValue;

    /**
     * Create a new job instance.
     * @param AttributeValue $attributeValue
     */
    public function __construct(AttributeValue $attributeValue)
    {
        $this->attributeValue = $attributeValue;
    }

    /**
     * @param AttributeValueRepositoryInterface $attributeValueRepository
     * @throws \Exception
     */
    public function handle(AttributeValueRepositoryInterface $attributeValueRepository): void
    {
        $this->attributeValue->products()->detach();
        $attributeValueRepository->delete($this->attributeValue);
    }
}
