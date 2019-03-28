<?php
declare(strict_types=1);

namespace App\Jobs\Attribute;

use App\Http\Requests\UpdateAttributeRequest;
use Henry\Domain\Attribute\Repositories\AttributeRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class StoreAttribute
 * @package App\Jobs\Attribute
 */
class StoreAttribute implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var string
     */
    private $name;

    /**
     * Create a new job instance.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param UpdateAttributeRequest $request
     * @return self
     */
    public static function fromRequest(UpdateAttributeRequest $request): self
    {
        return new static($request->name());
    }

    /**
     * @param AttributeRepositoryInterface $attributeRepository
     * @return Model
     */
    public function handle(AttributeRepositoryInterface $attributeRepository): Model
    {
        return $attributeRepository->create([
            'name' => $this->name
        ]);
    }
}
