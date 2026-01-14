<?php

namespace Domain\Admin\User\Actions;

use Domain\Admin\User\Dtos\UserDto;
use App\Domain\Core\Enums\CommonStatus;
use Domain\Admin\User\Services\RoleService;
use Domain\Admin\User\Services\UserService;
use App\Domain\Admin\User\Enums\UserEnumsStatus;

class UserAction
{
    /**
     * Constructor to inject the UserService dependency.
     *
     * @param UserService $service The service responsible for user operations.
     */
    public function __construct(private UserService $service, protected RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * Create a new user.
     *
     * @param UserDto $dto The data transfer object containing user details.
     * @return mixed Returns the created user data or result from the service.
     */
    public function createAction(UserDto $dto)
    {
        $dto->status =  CommonStatus::active->value;
        if ($dto->role == null) {
            $dto->role = $this->roleService->customerRoleId();
        }
        return $this->service->create($dto);
    }

    /**
     * Update an existing user.
     *
     * @param int $id The ID of the user to update.
     * @param UserDto $dto The data transfer object containing updated user details.
     * @return mixed Returns the updated user data or result from the service.
     */
    public function updateAction(int $id, UserDto $dto)
    {
        return $this->service->update($id, $dto);
    }

    /**
     * List all users.
     *
     * @return mixed Returns a list of users from the service.
     */
    public function listAction()
    {
        return $this->service->list();
    }

    /**
     * Deletes a user by their ID.
     *
     * @param int $id The ID of the user to delete.
     * @return mixed The result of the delete operation from the service layer.
     */
    public function deleteAction(int $id)
    {
        return $this->service->delete($id);
    }

    /**
     * Changes the password (or updates user details) for a specific user.
     *
     * @param int $userId The ID of the user whose password is being changed.
     * @param UserDto $dto The data transfer object containing the new password and/or other update data.
     * @return mixed The result of the update operation.
     */
    public function changePasswordAction(int $userId, UserDto $dto)
    {
        return $this->updateAction($userId, $dto);
    }
}
