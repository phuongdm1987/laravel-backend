<?php
declare(strict_types=1);

namespace Henry\Infrastructure;


use Henry\Domain\FilterInterface;
use Henry\Domain\RepositoryInterface;
use Henry\Domain\SorterInterface;
use Henry\Domain\ValueObjects\Order;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

/**
 * Class AbstractEloquentRepository
 * @package Henry\Infrastructure
 */
abstract class AbstractEloquentRepository implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @var FilterInterface
     */
    protected $filter;
    /**
     * @var SorterInterface
     */
    private $sorter;

    /**
     * AbstractEloquentRepository constructor.
     * @param Model $model
     * @param FilterInterface $filter
     * @param SorterInterface $sorter
     */
    public function __construct(Model $model, FilterInterface $filter, SorterInterface $sorter)
    {
        $this->model = $model;
        $this->filter = $filter;
        $this->sorter = $sorter;
    }

    /**
     * @param array $conditions
     * @return Collection
     */
    public function all(array $conditions = []): Collection
    {
        $query = $this->generateQueryBuilder($conditions);

        return $query->get();
    }

    /**
     * @param array $conditions
     * @param int $prePage
     * @return LengthAwarePaginator
     */
    public function withPaginate(array $conditions = [], $prePage = 15): LengthAwarePaginator
    {
        $query = $this->generateQueryBuilder($conditions);

        return $query->paginate($prePage);
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @param Model $model
     * @return bool
     */
    public function update(array $data, Model $model): bool
    {
        return $model->update($data);
    }

    /**
     * @param Model $model
     * @return bool|null
     * @throws \Exception
     */
    public function delete(Model $model): ?bool
    {
        return $model->delete();
    }

    /**
     * @param $id
     * @return Model|null
     */
    public function findById($id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * @param array $conditions
     * @return Model|null
     */
    public function findBy(array $conditions = []): ?Model
    {
        $query = $this->generateQueryBuilder($conditions);

        return $query->first();
    }

    /**
     * @param array $conditions
     * @return array
     */
    private function getIdsBySearch(array $conditions = []): array
    {
        if (!method_exists($this->model, 'search')) {
            return $conditions;
        }

        $queryParam = (string)Arr::get($conditions, 'q', '');

        if (!$queryParam) {
            return $conditions;
        }

        $primaryKey = $this->model->getKeyName();
        $ids = $this->model->search($queryParam)->get()->pluck($primaryKey)->toArray();

        Arr::forget($conditions, 'q');
        $conditions[$primaryKey] = $ids;

        return $conditions;
    }

    /**
     * @param array $conditions
     * @return Order
     */
    private function generateOrderInfoByQueryParams(array $conditions = []): Order
    {
        $orderBy = Arr::get($conditions, 'orderBy', '');
        $order = Arr::get($conditions, 'order', 'asc');
        return new Order($orderBy, $order);
    }

    /**
     * @param array $conditions
     * @return Builder
     */
    protected function generateQueryBuilder(array $conditions): Builder
    {
        $conditions = $this->getIdsBySearch($conditions);
        $queryBuilder = $this->model->newModelQuery();

        $query = $this->filter->filter($queryBuilder, $conditions);
        $orderObject = $this->generateOrderInfoByQueryParams($conditions);
        $query = $this->sorter->order($query, $orderObject);

        return $query;
    }
}
