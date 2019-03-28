<?php
declare(strict_types=1);

namespace App\Jobs\Attribute;

use Henry\Domain\Attribute\Attribute;
use Henry\Domain\Attribute\Repositories\AttributeRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class DeleteAttribute
 * @package App\Jobs\Attribute
 */
class DeleteAttribute implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var Attribute
     */
    private $attribute;

    /**
     * Create a new job instance.
     * @param Attribute $attribute
     */
    public function __construct(Attribute $attribute)
    {
        $this->attribute = $attribute;
    }

    /**
     * @param AttributeRepositoryInterface $attributeRepository
     * @return bool
     * @throws \Exception
     */
    public function handle(AttributeRepositoryInterface $attributeRepository): bool
    {
        if (!$this->attribute->attributeValues->isEmpty()) {
            return false;
        }

        $this->attribute->categories()->detach();
        $attributeRepository->delete($this->attribute);

        return true;
    }
}
