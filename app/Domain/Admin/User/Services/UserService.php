<?php

namespace Domain\Admin\User\Services;

use App\Infrastructure\Persistence\UserRepository;
use DB;
use Domain\Admin\User\Dtos\UserDto;
use Domain\Admin\User\Entities\UserEntity;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Log;
use NodeSpace\CommonHelpers\Helpers\UserHelper;


class UserService
{
    private $userEntity;

    protected $dbObject;

    /**
     * Create a new instance of the class.
     * Initializes the user repository dependency, sets the user entity class,
     * and assigns the database facade reference for database operations.
     * @param  \Domain\Admin\User\Repositories\UserRepository  $userRepository
     * The repository instance used for managing user-related data.
     */
    public function __construct(private UserRepository $userRepository)
    {
        $this->userEntity = UserEntity::class;
        $this->dbObject = DB::class;
    }

    /**
     * function to create the of user
     *
     * @param UserDto $dto
     * @return UserEntity
     */
    public function create(UserDto $dto): ?UserEntity
    {
        try {
            $userEntity = $this->userEntity::fromDto($dto);
            $this->dbObject::beginTransaction();
            if ($dto->image instanceof UploadedFile) {
                $destinationPath = config('constants.profile_image_path');
                $filename = basename(UserHelper::uploadImage($dto->image, $destinationPath));
                $userEntity->image = $filename;
            }

            $userData = $this->userRepository->addData($userEntity->toArray());
            $userDataEntity = $this->userEntity::fromModel($userData);
            if (!empty($dto->role)) {
                $userData->assignRole((int) $dto->role);
            }
            $this->dbObject::commit();
            return $userDataEntity;
        } catch (Exception $exception) {
            Log::error('user creation failed: ' . json_encode([
                'message' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
                'dto' => $dto,
            ]));
            return null;
        }
    }

    /**
     * function to handle the user update functionality
     *
     * @param integer $id
     * @param UserDto $dto
     * @return UserEntity
     */
    public function update(int $id, UserDto $dto): ?UserEntity
    {
        try {
            $entity = $this->userEntity::fromDto($dto);
            $this->dbObject::beginTransaction();
            $data = $entity->toArray();
            if (empty($dto->password)) {
                unset($data['password']);
            } else {
                $data['password'] = bcrypt($dto->password);
            }

            if ($dto->image instanceof UploadedFile) {
                $destinationPath = config('constants.profile_image_path');
                $user = $this->getDataById($id);
                if (!empty($userData->image)) {
                    UserHelper::deleteImage($destinationPath, $user->image);
                }
                $filename = basename(UserHelper::uploadImage($dto->image, $destinationPath));
                $data['image'] = $filename;
            } else {
                unset($data['image']);
            }
            $userData = $this->userRepository->updateData($id, $data);
            if (!empty($dto->role)) {
                $userData->syncRoles([(int) $dto->role]);
            }

            $this->dbObject::commit();
            return $this->userEntity::fromModel($userData);
        } catch (Exception $exception) {
            Log::error('user update failed: ' . json_encode([
                'message' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
                'dto' => $dto,
            ]));
            return null;
        }
    }

    /**
     * function to handle the delete the user
     *
     * @param integer $id
     * @return UserEntity
     */
    public function delete(int $id): UserEntity
    {
        $userData = $this->userRepository->deleteDataById($id);
        return $this->userEntity::fromModel($userData);
    }

    /**
     * function to get all the data
     *
     * @return Collection
     */
    public function list(): Collection
    {
        return $this->userRepository->getAllData();
    }

    /**
     * function to get the data from id
     *
     * @param integer $id
     * @return UserEntity
     */
    public function getDataById(int $id): UserEntity
    {
        $userData = $this->userRepository->getDataById($id);
        return $this->userEntity::fromModel($userData);
    }

    /**
     * Retrieve the total number of customers.
     *
     * This method calls the user repository to fetch and return
     * the total count of all customers stored in the system.
     * Typically used for dashboard statistics or reporting.
     *
     * @return int
     */
    public function customerDataCount()
    {
        return $this->userRepository->getAllCustomerData();
    }
}
