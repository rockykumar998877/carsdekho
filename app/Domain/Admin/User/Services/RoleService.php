<?php

namespace Domain\Admin\User\Services;

use App\Infrastructure\Persistence\RoleRepository;
use DB;
use Exception;
use Domain\Admin\User\Dtos\RoleDto;
use Domain\Admin\User\Entities\RoleEntity;
use Illuminate\Database\Eloquent\Collection;
use Log;

class RoleService
{
    private $roleEntity;

    protected $dbObject;

    /**
     * Create a new instance of the class.
     * Initializes the role repository dependency, sets the role entity class,
     * and assigns the database facade reference for database operations.
     * @param  \Domain\Admin\Role\Repositories\RoleRepository  $roleRepository
     * The repository instance used for managing role-related data.
     */
    public function __construct(private RoleRepository $roleRepository)
    {
        $this->roleEntity = RoleEntity::class;
        $this->dbObject = DB::class;
    }

    /**
     * function to create the of Role
     *
     * @param ProductDto $dto
     * @return RoleEntity
     */
    public function create(RoleDto $dto): ?RoleEntity
    {
        try {
            $roleEntity = $this->roleEntity::fromDto($dto);
            $this->dbObject::beginTransaction();
            $roleData = $this->roleRepository->addData($roleEntity->toArray());
            $roleDataEntity = $this->roleEntity::fromModel($roleData);
            if (!empty($roleEntity->permissions)) {
                $roleData->permissions()->sync($roleEntity->permissions);
            }
            $this->dbObject::commit();
            return $roleDataEntity;
        } catch (Exception $exception) {
            Log::error('role creation failed: ' . json_encode([
                'message' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
                'dto' => $dto,
            ]));

            return null;
        }
    }

    /**
     * function to handle the product update functionality
     *
     * @param integer $id
     * @param RoleDto $dto
     * @return RoleEntity
     */
    public function update(int $id, RoleDto $dto): ?RoleEntity
    {
        try {
            $roleEntity = $this->roleEntity::fromDto($dto);
            $this->dbObject::beginTransaction();
            $roleData = $this->roleRepository->updateData($id, $roleEntity->toArray());
            $roleEntityData = $this->roleEntity::fromModel($roleData);
            $roleData->permissions()->sync($roleEntity->permissions);
            $this->dbObject::commit();
            return $roleEntityData;
        } catch (Exception $exception) {
            Log::error('role update failed: ' . json_encode([
                'message' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
                'dto' => $dto,
            ]));
            return null;
        }
    }

    /**
     * function to handle the delete the Role
     *
     * @param integer $id
     * @return RoleEntity
     */
    public function delete(int $id): RoleEntity
    {
        $roleData = $this->roleRepository->deleteDataById($id);
        return $this->roleEntity::fromModel($roleData);
    }

    /**
     * function to get all the data
     *
     * @return Collection
     */
    public function list(): Collection
    {
        return $this->roleRepository->getAllData();
    }

    /**
     * function to get the data from id
     *
     * @param integer $id
     * @return RoleEntity
     */
    public function getDataById(int $id): RoleEntity
    {
        $roleData = $this->roleRepository->getDataById($id);
        return $this->roleEntity::fromModel($roleData);
    }

    /**
     * Retrieve the ID of the customer role.
     *
     * This method fetches the first record from the list of roles,
     * then calls the `customerId()` scope or relationship to get the
     * customer-specific role, and finally returns its 'id' value.
     *
     * @return int|null The ID of the customer role, or null if not found.
     */
    public function customerRoleId()
    {
        return $this->list()->first()->customerId()->value('id');
    }
}
