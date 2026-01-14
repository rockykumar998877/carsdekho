<?php

namespace Domain\Core\Interfaces\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

interface BaseRepositoryInterface
{
    // Get all records
    public function getAllData(): Collection;

    // Get a single record by ID
    public function getDataById(string $id): ?Model;

    // Add a new record
    public function addData(array $data): ?Model;

    // Update an existing record by ID
    public function updateData(string $id, array $updatedData): ?Model;

    // Delete a record by ID
    public function deleteDataById(string $id): ?Model;

    // Get records based on filter conditions
    public function getDataOnBasisOfFilter(array $filters): Collection;

    // Update existing record or create a new one if not found
    public function updateOrCreateData(array $conditions, mixed $data): ?Model;

    // Get paginated data for the model
    public function paginatedData(int $perPage);

    /**
     * function to get all the active records data
     *
     * @param [type] $activeStatusValue
     * @return void
     */
    public function getAllActiveData($activeStatusValue);
}
