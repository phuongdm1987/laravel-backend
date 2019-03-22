<?php
declare(strict_types=1);

namespace App\Jobs\Product;

use App\Http\Requests\UpdateProductRequest;
use Henry\Domain\Product\Repositories\ProductRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class StoreProduct
 * @package App\Jobs\Product
 */
class StoreProduct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var int
     */
    private $categoryId;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $description;

    /**
     * Create a new job instance.
     * @param int $categoryId
     * @param string $name
     * @param string $description
     */
    public function __construct(int $categoryId, string $name, string $description = '')
    {
        $this->categoryId = $categoryId;
        $this->name = $name;
        $this->description = $description;
    }

    /**
     * @param UpdateProductRequest $request
     * @return self
     */
    public static function fromRequest(UpdateProductRequest $request): self
    {
        return new static($request->categoryId(), $request->name(), $request->description());
    }

    /**
     * @param ProductRepositoryInterface $productRepository
     * @return Model
     */
    public function handle(ProductRepositoryInterface $productRepository): Model
    {
        return $productRepository->create([
            'category_id' => $this->categoryId,
            'name' => $this->name,
            'description' => $this->description
        ]);
    }
}
