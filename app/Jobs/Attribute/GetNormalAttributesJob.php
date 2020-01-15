<?php
declare(strict_types=1);

namespace App\Jobs\Attribute;

use Henry\Domain\Attribute\Repositories\AttributeRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class GetNormalAttributesJob
 * @package App\Jobs\Attribute
 */
class GetNormalAttributesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var array
     */
    private $conditions;
    /**
     * @var int
     */
    private $prePage;

    /**
     * Create a new job instance.
     * @param array $conditions
     * @param int $prePage
     */
    public function __construct(array $conditions = [], $prePage = 15)
    {
        $this->conditions = $conditions;
        $this->prePage = $prePage;
    }

    /**
     * @param AttributeRepositoryInterface $attributeRepository
     * @return LengthAwarePaginator|Collection
     */
    public function handle(AttributeRepositoryInterface $attributeRepository)
    {
        if ($this->prePage > 0) {
            return $attributeRepository->withPaginate($this->conditions, $this->prePage);
        }

        return $attributeRepository->all($this->conditions);
    }
}
