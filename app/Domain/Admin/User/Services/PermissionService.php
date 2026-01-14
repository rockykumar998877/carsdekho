<?php

namespace Domain\Admin\User\Services;

use App\Infrastructure\Persistence\PermissionRepository;
use Exception;
use Domain\Admin\User\Dtos\PermissionDto;
use Domain\Admin\User\Entities\PermissionEntity;
use Illuminate\Database\Eloquent\Collection;
use Log;

class PermissionService
{
    private $permissionEntity;

    /**
     * Create a new instance of the class.
     * Initializes the permission repository dependency and sets
     * the permission entity class reference.
     * @param  \Domain\Admin\Permission\Repositories\PermissionRepository  $permissionRepository
     * The repository instance used for managing permission data.
     */
    public function __construct(private PermissionRepository $permissionRepository)
    {
        $this->permissionEntity = PermissionEntity::class;
    }

    /**
     * function to create the of permission
     *
     * @param PermissionDto $dto
     * @return PermissionEntity
     */
    public function create(PermissionDto $dto): ?PermissionEntity
    {
        try {
            $permissionEntity = $this->permissionEntity::fromDto($dto);
            $permissionData = $this->permissionRepository->addData($permissionEntity->toArray());
            $permissionEntityData = $this->permissionEntity::fromModel($permissionData);
            return $permissionEntityData;
        } catch (Exception $exception) {
            Log::error('permission update failed: ' . json_encode([
                'message' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
                'dto' => $dto,
            ]));
            return null;
        }
    }

    /**
     * function to handle the permission update functionality
     *
     * @param integer $id
     * @param PermissionDto $dto
     * @return PermissionEntity
     */
    public function update(int $id, PermissionDto $dto): ?PermissionEntity
    {
        try {
            $entity = $this->permissionEntity::fromDto($dto);
            $permissionData = $this->permissionRepository->updateData($id, $entity->toArray());
            $permissionEntityData = $this->permissionEntity::fromModel($permissionData);
            return $permissionEntityData;
        } catch (Exception $exception) {
            Log::error('permission update failed: ' . json_encode([
                'message' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
                'dto' => $dto,
            ]));
            return null;
        }
    }

    /**
     * function to handle the delete the permission
     *
     * @param integer $id
     * @return PermissionEntity
     */
    public function delete(int $id): PermissionEntity
    {
        $permissionData = $this->permissionRepository->deleteDataById($id);
        return $this->permissionEntity::fromModel($permissionData);
    }

    /**
     * function to get all the data 
     *
     * @return Collection
     */
    public function list(): Collection
    {
        return $this->permissionRepository->getAllData();
    }

    /**
     * function to get the data from id
     *
     * @param integer $id
     * @return PermissionEntity
     */
    public function getDataById(int $id): PermissionEntity
    {
        $permissionData = $this->permissionRepository->getDataById($id);
        return $this->permissionEntity::fromModel($permissionData);
    }
}
