<?php
declare(strict_types=1);

namespace Henry\Domain;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface RepositoryInterface
 * @package Henry\Domain
 */
interface RepositoryInterface
{
    /**
     * @param array $conditions
     * @return Collection
     */
    public function all(array $conditions = []): Collection;

    /**
     * @param array $conditions
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function withPaginate(array $conditions = [], $perPage = 15): LengthAwarePaginator;

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model;

    /**
     * @param array $data
     * @param Model $model
     * @return bool
     */
    public function update(array $data, Model $model): bool;

    /**
     * @param Model $model
     * @return bool|null
     * @throws \Exception
     */
    public function delete(Model $model): ?bool;

    /**
     * @param $id
     * @return Model
     */
    public function findById($id): Model;
}
