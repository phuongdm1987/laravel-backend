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
     * @return mixed
     */
    public function create(array $data): Model;

    /**
     * @param array $data
     * @param $id
     * @return bool
     */
    public function update(array $data, $id): bool;

    /**
     * @param $id
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id): ?bool;

    /**
     * @param $id
     * @return Model
     */
    public function findById($id): Model;
}
