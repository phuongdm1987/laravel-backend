<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Product\Repositories;


use Henry\Domain\Product\Filters\ProductFilterInterface;
use Henry\Domain\Product\Product;
use Henry\Domain\Product\Repositories\ProductRepositoryInterface;
use Henry\Infrastructure\AbstractEloquentRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class EloquentProductRepository
 * @package Henry\Infrastructure\Product\Repositories
 */
class EloquentProductRepository extends AbstractEloquentRepository implements ProductRepositoryInterface
{
    /**
     * AbstractEloquentRepository constructor.
     * @param Product $model
     * @param ProductFilterInterface $filter
     */
    public function __construct(Product $model, ProductFilterInterface $filter)
    {
        parent::__construct($model, $filter);
    }

    /**
     * @param array $conditions
     * @return Collection
     */
    public function getTopBySearch(array $conditions = []): Collection
    {
        $queryParam = (string)array_get($conditions, 'q', '');
        $queryBuild = $this->getModelQueryBuilder($queryParam);

        $query = $this->filter->filter($queryBuild, $conditions);

        return $query->take(10)->get();
    }
}
