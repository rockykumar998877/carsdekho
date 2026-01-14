<?php

namespace Domain\Core\Interfaces\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

interface BaseServiceInterface
{
    /**
     * Create a new record.
     *
     * @param  mixed  $data  The data used to create the record.
     * @return mixed  The created record or operation result.
     */
    public function create(mixed $data);

    /**
     * Update an existing record by its ID.
     *
     * @param  string  $id   The unique identifier of the record to update.
     * @param  mixed   $dto  The data transfer object or array containing updated data.
     * @return mixed  The updated record or operation result.
     */
    public function update(string $id, mixed $dto): mixed;

    /**
     * Delete a record by its ID.
     *
     * @param  string  $id  The unique identifier of the record to delete.
     * @return mixed  The result of the delete operation.
     */
    public function delete(string $id): mixed;

    /**
     * Retrieve a list of all records.
     *
     * @return \Illuminate\Support\Collection  A collection of all records.
     */
    public function list(): Collection;

    /**
     * Retrieve a single record by its ID.
     *
     * @param  string  $id  The unique identifier of the record.
     * @return \Illuminate\Database\Eloquent\Model  The model instance for the given ID.
     */
    public function getDataById(string $id): Model;
}
