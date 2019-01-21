<?php
declare(strict_types=1);

namespace Henry\Infrastructure;


use Henry\Domain\FilterInterface;
use Henry\Domain\RepositoryInterface;
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
     * AbstractEloquentRepository constructor.
     * @param Model $model
     * @param FilterInterface $filter
     */
    public function __construct(Model $model, FilterInterface $filter)
    {
        $this->model = $model;
        $this->filter = $filter;
    }

    /**
     * @param array $conditions
     * @return Collection
     */
    public function all(array $conditions = []): Collection
    {
        $query = $this->filter->filter($this->getModelQueryBuilder(), $conditions);

        return $query->get();
    }

    /**
     * @param array $conditions
     * @param int $prePage
     * @return LengthAwarePaginator
     */
    public function withPaginate(array $conditions = [], $prePage = 15): LengthAwarePaginator
    {
        $queryParam = array_get($conditions, 'q', '');
        $queryBuild = $this->getModelQueryBuilder($queryParam);

        $query = $this->filter->filter($queryBuild, $conditions);

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
}
