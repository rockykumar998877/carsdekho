<?php

namespace App\Infrastructure\Persistence;

use Domain\Admin\User\Models\Role;
use Domain\Core\Repositories\BaseRepository;

class RoleRepository extends BaseRepository
{
    /**
     * Create a new instance of the class.
     *
     * This constructor injects the Role model instance
     * and assigns it to the class property for later use.
     *
     * @param \Domain\Admin\User\Models\Role $model
     */
    public function __construct(Role $model)
    {
        $this->model = $model;
    }
}
