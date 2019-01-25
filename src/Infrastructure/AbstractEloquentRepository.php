<?php
declare(strict_types=1);

namespace Henry\Infrastructure;


use Henry\Domain\FilterInterface;
use Henry\Domain\RepositoryInterface;
use Henry\Domain\SorterInterface;
use Henry\Domain\ValueObjects\Order;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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
        $this->model->create($data);
    }

    /**
     * @param array $data
     * @param $id
     * @return bool
     */
    public function update(array $data, $id): bool
    {
        $model = $this->findById($id);
        return $model->update($data);
    }

    /**
     * @param $id
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id): ?bool
    {
        $model = $this->findById($id);
        return $model->delete();
    }

    /**
     * @param $id
     * @return Model
     */
    public function findById($id): Model
    {
        $this->model->find($id);
    }

    /**
     * @param string $query
     * @return \Illuminate\Database\Eloquent\Builder|Model
     */
    public function getModelQueryBuilder(string $query = '')
    {
        return $query ? $this->model->search($query) : $this->model->newModelQuery();
    }

    /**
     * @param array $conditions
     * @return Order
     */
    private function generateOrderInfoByQueryParams(array $conditions = []): Order
    {
        $orderBy = array_get($conditions, 'orderBy', '');
        $order = array_get($conditions, 'order', 'asc');
        return new Order($orderBy, $order);
    }

    /**
     * @param array $conditions
     * @return \Illuminate\Database\Eloquent\Builder|\Laravel\Scout\Builder
     */
    private function generateQueryBuilder(array $conditions)
    {
        $queryParam = (string)array_get($conditions, 'q', '');
        $queryBuild = $this->getModelQueryBuilder($queryParam);

        $query = $this->filter->filter($queryBuild, $conditions);
        $orderObject = $this->generateOrderInfoByQueryParams($conditions);
        $query = $this->sorter->order($query, $orderObject);

        return $query;
    }
}
