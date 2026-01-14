<?php

namespace Domain\Core\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Domain\Core\Interfaces\Repositories\BaseRepositoryInterface;

abstract class BaseRepository implements BaseRepositoryInterface
{
    /**
     * The model instance used by the repository.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected Model $model;

    /**
     * Create a new repository instance.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Filter incoming data based on the model's fillable attributes.
     *
     * @param array $data  Input data to filter.
     * @return array  Filtered data containing only fillable fields.
     */
    protected function filterData(array $data): array
    {
        $fillable = $this->model->getFillable();

        if (empty($fillable)) {
            return $data;
        }

        return collect($data)->only($fillable)->toArray();
    }

    /**
     * Retrieve all records for the model.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllData(): Collection
    {
        return $this->model->get();
    }

    /**
     * Retrieve a single record by its ID.
     *
     * @param string $id  Record ID.
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function getDataById(string $id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * Create a new record in the database.
     *
     * @param array $data  Data to create the record with.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function addData(array $data): Model
    {
        return $this->model->create($this->filterData($data));
    }

    /**
     * Update an existing record by its ID.
     *
     * @param string $id  Record ID.
     * @param mixed $updatedData  Data to update the record with.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function updateData(string $id, mixed $updatedData): Model
    {
        $data = $this->model::findOrFail($id);
        $data->update($this->filterData($updatedData));
        return $data;
    }

    /**
     * Delete a record by its ID.
     *
     * @param string $id  Record ID.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function deleteDataById(string $id): Model
    {
        $data = $this->model->find($id);
        $data->delete();
        return $data;
    }

    /**
     * Retrieve records that match specific filter conditions.
     *
     * @param array $filters  Key-value pairs used for filtering results.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getDataOnBasisOfFilter(array $filters): Collection
    {
        $query = $this->model::query();
        foreach ($filters as $key => $value) {
            $query->where($key, $value);
        }
        return $query->get();
    }

    /**
     * Update an existing record or create a new one if it doesn't exist.
     *
     * @param array $conditions  Conditions to find the record.
     * @param mixed $data  Data to update or create the record with.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function updateOrCreateData(array $conditions, mixed $data): Model
    {
        return $this->model::updateOrCreate(
            $conditions,
            $this->filterData($data)
        );
    }

    /**
     * Retrieve paginated records for the model.
     *
     * @param int $perPage  Number of records per page (default: 10).
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginatedData(int $perPage = 10)
    {
        return $this->model->paginate($perPage);
    }

    /**
     * function to get all the active data
     *
     * @param mixed $activeStatusValue
     * @return void
     */
    public function getAllActiveData($activeStatusValue)
    {
        return $this->model::activeData($activeStatusValue)->get();
    }
}
