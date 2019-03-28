<?php
declare(strict_types=1);

namespace App\Jobs\Attribute;

use Henry\Domain\Attribute\Repositories\AttributeRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class GetNormalAttributes
 * @package App\Jobs\Attribute
 */
class GetNormalAttributes implements ShouldQueue
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
     * @return LengthAwarePaginator
     */
    public function handle(AttributeRepositoryInterface $attributeRepository): LengthAwarePaginator
    {
        return $attributeRepository->withPaginate($this->conditions, $this->prePage);
    }
}
