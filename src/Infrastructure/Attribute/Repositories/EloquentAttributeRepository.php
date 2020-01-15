<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Attribute\Repositories;


use Henry\Domain\Attribute\Filters\AttributeFilterInterface;
use Henry\Domain\Attribute\Attribute;
use Henry\Domain\Attribute\Repositories\AttributeRepositoryInterface;
use Henry\Domain\Attribute\Sorters\AttributeSorterInterface;
use Henry\Infrastructure\AbstractEloquentRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class EloquentAttributeRepository
 * @package Henry\Infrastructure\Attribute\Repositories
 */
class EloquentAttributeRepository extends AbstractEloquentRepository implements AttributeRepositoryInterface
{
    /**
     * AbstractEloquentRepository constructor.
     * @param Attribute $model
     * @param AttributeFilterInterface $filter
     * @param AttributeSorterInterface $sorter
     */
    public function __construct(Attribute $model, AttributeFilterInterface $filter, AttributeSorterInterface $sorter)
    {
        parent::__construct($model, $filter, $sorter);
    }

    /**
     * @param string $query
     * @return Collection
     */
    public function getTopBySearch(string $query = ''): Collection
    {
        $query = $this->generateQueryBuilder(['q' => $query]);

        return $query->take(10)->get();
    }
}
