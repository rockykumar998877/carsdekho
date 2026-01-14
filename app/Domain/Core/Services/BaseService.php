<?php

namespace App\Domain\Core\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Domain\Core\Interfaces\Services\BaseServiceInterface;
use Domain\Core\Interfaces\Repositories\BaseRepositoryInterface;

class BaseService implements BaseServiceInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(private BaseRepositoryInterface $repository){}

    /**
     * function to add the data to the database
     *
     * @param mixed $data
     * @return mixed
     */
    public function create(mixed $data):mixed
    {
        return $this->repository->addData($data);
    }

    /**
     * function to update the data
     *
     * @param string $id
     * @param mixed $dto
     * @return mixed
     */
    public function update(string $id, mixed $dto):mixed
    {
        return $this->repository->updateData($id, $dto);
    }

    /**
     * function to delete the data
     *
     * @param string $id
     * @return mixed
     */
    public function delete(string $id): mixed
    {
        return $this->repository->deleteDataById($id);
    }

    /**
     * function to get all the data
     *
     * @return Collection
     */
    public function list(): Collection
    {
        return $this->repository->getAllData();
    }

    /**
     * function to get data on basis of id
     *
     * @param string $id
     * @return Model
     */
    public function getDataById(string $id): Model
    {
        return $this->repository->getDataById($id);
    }
}
