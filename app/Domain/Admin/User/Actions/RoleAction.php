<?php

namespace Domain\Admin\User\Actions;

use Domain\Admin\User\Dtos\RoleDto;
use Domain\Admin\User\Services\RoleService;

class RoleAction
{
    /**
     * Constructor to inject the RoleService dependency.
     *
     * @param RoleService $service The service responsible for role operations.
     */
    public function __construct(private RoleService $service) {}

    /**
     * Create a new role.
     *
     * @param RoleDto $dto The data transfer object containing role details.
     * @return mixed Returns the created role data or result from the service.
     */
    public function createRole(RoleDto $dto)
    {
        return $this->service->create($dto);
    }

    /**
     * Update an existing role.
     *
     * @param int $id The ID of the role to update.
     * @param RoleDto $dto The data transfer object containing updated role details.
     * @return mixed Returns the updated role data or result from the service.
     */
    public function updateRole(int $id, RoleDto $dto)
    {
        return $this->service->update($id, $dto);
    }

    /**
     * List all roles.
     *
     * @return mixed Returns a list of roles from the service.
     */
    public function listRole()
    {
        return $this->service->list();
    }

    public function deleteAction($id)
    {
       return $this->service->delete($id);
    }
}
