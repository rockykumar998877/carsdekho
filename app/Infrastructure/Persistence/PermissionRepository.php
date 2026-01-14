<?php

namespace App\Infrastructure\Persistence;

use Domain\Admin\User\Models\Permission;
use Domain\Core\Repositories\BaseRepository;

class PermissionRepository extends BaseRepository
{
    public function __construct(Permission $model)
    {
        $this->model = $model;
    }
}
