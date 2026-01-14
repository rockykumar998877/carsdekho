<?php

namespace Domain\Admin\User\Actions;

use Domain\Admin\User\Dtos\PermissionDto;
use Domain\Admin\User\Services\PermissionService;

class PermissionAction
{
    /**
     * Constructor for the CreatePermissionAction.
     *
     * @param PermissionService $service Service class responsible for permission operations.
     */
    public function __construct(private PermissionService $service) {}

    /**
     * Execute the action to create a new permission.
     *
     * @param PermissionDto $dto Data Transfer Object containing permission details.
     * @return \Domain\Admin\User\Entities\PermissionEntity The created permission entity.
     */
    public function createPermission(PermissionDto $dto)
    {
        return $this->service->create($dto);
    }

    /**
     * Execute the action to retrieve the list of all permissions.
     *
     * @return \Illuminate\Support\Collection Collection of permission entities.
     */
    public function listPermission()
    {
        return $this->service->list();
    }

    /**
     * Execute the action to update an existing permission.
     *
     * @param int $id The ID of the permission to update.
     * @param PermissionDto $dto Data Transfer Object containing updated permission details.
     * @return \Domain\Admin\User\Entities\PermissionEntity The updated permission entity.
     */
    public function updatePermission(int $id, PermissionDto $dto)
    {
        return $this->service->update($id, $dto);
    }

    /**
     * Handle the delete action for a specific record.
     *
     * This method calls the service layer to delete the record 
     * associated with the given ID.
     *
     * @param  int  $id  The unique identifier of the record to delete.
     * @return mixed  The response from the service after attempting deletion.
     */
    public function deleteAction($id)
    {
        return $this->service->delete($id);
    }
}
