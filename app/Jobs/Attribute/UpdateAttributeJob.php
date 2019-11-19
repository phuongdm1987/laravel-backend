<?php
declare(strict_types=1);

namespace App\Jobs\Attribute;

use App\Http\Requests\UpdateAttributeRequest;
use Henry\Domain\Attribute\Attribute;
use Henry\Domain\Attribute\Repositories\AttributeRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class UpdateAttributeJob
 * @package App\Jobs\Attribute
 */
class UpdateAttributeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var array
     */
    private $attributes;
    /**
     * @var Attribute
     */
    private $attribute;

    /**
     * Create a new job instance.
     * @param array $attributes
     * @param Attribute $attribute
     */
    public function __construct(array $attributes, Attribute $attribute)
    {
        $this->attributes = $attributes;
        $this->attribute = $attribute;
    }

    /**
     * @param UpdateAttributeRequest $request
     * @param Attribute $attribute
     * @return self
     */
    public static function fromRequest(UpdateAttributeRequest $request, Attribute $attribute): self
    {
        return new static(
            [
                'name' => $request->name()
            ],
            $attribute
        );
    }

    /**
     * @param AttributeRepositoryInterface $attributeRepository
     */
    public function handle(AttributeRepositoryInterface $attributeRepository): void
    {
        $attributeRepository->update($this->attributes, $this->attribute);
    }
}
