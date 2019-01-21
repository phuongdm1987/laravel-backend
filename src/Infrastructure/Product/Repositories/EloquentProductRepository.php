<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Product\Repositories;


use Henry\Domain\Product\Filters\ProductFilterInterface;
use Henry\Domain\Product\Product;
use Henry\Domain\Product\Repositories\ProductRepositoryInterface;
use Henry\Infrastructure\AbstractEloquentRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

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
}
