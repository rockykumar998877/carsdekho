<?php

namespace App\Infrastructure\Persistence;

use Domain\Admin\User\Models\User;
use Domain\Core\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Get the total count of all customers from the database.
     *
     * This method retrieves all customer records using the model’s
     * `getAllCustomer()` scope or query method, and returns the total count.
     * Commonly used for analytics or dashboard summaries.
     *
     * @return int
     */
    public function getAllCustomerData()
    {
        return $this->model->getAllCustomer()->count();
    }
}
