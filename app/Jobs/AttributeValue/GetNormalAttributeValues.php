<?php
declare(strict_types=1);

namespace App\Jobs\AttributeValue;

use Henry\Domain\AttributeValue\Repositories\AttributeValueRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class GetNormalAttributeValues
 * @package App\Jobs\AttributeValue
 */
class GetNormalAttributeValues implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var array
     */
    private $conditions;
    /**
     * @var int
     */
    private $perPage;

    /**
     * Create a new job instance.
     * @param array $conditions
     * @param int $perPage
     */
    public function __construct(array $conditions = [], $perPage = 15)
    {
        $this->conditions = $conditions;
        $this->perPage = $perPage;
    }

    /**
     * @param AttributeValueRepositoryInterface $attributeValueRepository
     * @return LengthAwarePaginator
     */
    public function handle(AttributeValueRepositoryInterface $attributeValueRepository): LengthAwarePaginator
    {
        return $attributeValueRepository->withPaginate($this->conditions, $this->perPage);
    }
}
