<?php
declare(strict_types=1);

namespace Henry\Domain;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface RepositoryInterface
 * @package Henry\Domain
 */
interface RepositoryInterface
{
    /**
     * @return Collection
     */
    public function all(): Collection;

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
     * @return mixed
     */
    public function findById($id): Model;
}
