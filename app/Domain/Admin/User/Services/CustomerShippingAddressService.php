<?php

namespace Domain\Admin\User\Services;

use Log;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use NodeSpace\CommonHelpers\Helpers\UserHelper;
use App\Domain\Admin\User\Enums\UserEnumsStatus;
use Domain\Admin\User\Dtos\CustomerShippingAddressDto;
use Domain\Admin\User\Entities\CustomerShippingAddressEntity;
use App\Infrastructure\Persistence\CustomerShippingAddressRepository;

class CustomerShippingAddressService
{
    private $customerShippingAddressEntity;

    /**
     * Create a new instance of the class.
     * Initializes the repository dependency and sets the
     * customer shipping address entity class.
     * @param  \Domain\Customer\Repositories\CustomerShippingAddressRepository  $customerShippingAddressRepository
     * The repository instance used for managing customer shipping addresses.
     */
    public function __construct(private CustomerShippingAddressRepository $customerShippingAddressRepository)
    {
        $this->customerShippingAddressEntity = CustomerShippingAddressEntity::class;
    }

    /**
     * Function to create a new customer shipping address
     *
     * @param CustomerShippingAddressDto $dto
     * @return CustomerShippingAddressEntity|null
     */
    public function create(CustomerShippingAddressDto $dto): ?CustomerShippingAddressEntity
    {
        try {
            $customerShippingAddressEntity = $this->customerShippingAddressEntity::fromDto($dto);
            $data = $this->customerShippingAddressRepository->addData($customerShippingAddressEntity->toArray());
            $entityData = $this->customerShippingAddressEntity::fromModel($data);
            return $entityData;
        } catch (Exception $exception) {
            Log::error('Customer Shipping Address creation failed: ' . json_encode([
                'message' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
                'dto' => $dto,
            ]));
            return null;
        }
    }

    /**
     * Function to update a customer shipping address
     *
     * @param int $id
     * @param CustomerShippingAddressDto $dto
     * @return CustomerShippingAddressEntity|null
     */
    public function update(int $id, CustomerShippingAddressDto $dto): ?CustomerShippingAddressEntity
    {
        try {
            $entity = $this->customerShippingAddressEntity::fromDto($dto);
            $data = $this->customerShippingAddressRepository->updateData($id, $entity->toArray());
            return $this->customerShippingAddressEntity::fromModel($data);
        } catch (Exception $exception) {
            Log::error('Customer Shipping Address update failed: ' . json_encode([
                'message' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
                'dto' => $dto,
            ]));
            return null;
        }
    }

    /**
     * Function to delete a customer shipping address
     *
     * @param int $id
     * @return CustomerShippingAddressEntity|null
     */
    public function delete(int $id): ?CustomerShippingAddressEntity
    {
        try {
            $data = $this->customerShippingAddressRepository->deleteDataById($id);
            return $this->customerShippingAddressEntity::fromModel($data);
        } catch (Exception $exception) {
            Log::error('Customer Shipping Address deletion failed: ' . $exception->getMessage());
            return null;
        }
    }

    /**
     * Function to list all customer shipping addresses
     *
     * @return Collection
     */
    public function list(): Collection
    {
        return $this->customerShippingAddressRepository->getAllData();
    }

    /**
     * Function to get a customer shipping address by ID
     *
     * @param int $id
     * @return CustomerShippingAddressEntity|null
     */
    public function getDataById(int $id): CustomerShippingAddressEntity
    {
        $data = $this->customerShippingAddressRepository->getDataById($id);
        return $this->customerShippingAddressEntity::fromModel($data);
    }

    /**
     * Retrieve all active shipping addresses for the given user.
     *
     * This method fetches the user's active shipping address records
     * by delegating the data retrieval to the CustomerShippingAddressRepository.
     *
     * @param  int  $userId  The ID of the user whose active shipping addresses are to be retrieved.
     * @return array  The list of active shipping addresses associated with the user.
     */
    public function getCustomerShippingAddress($userId)
    {
        return $this->customerShippingAddressRepository->getDataOnBasisOfFilter(['user_id' => $userId, 'status' => UserEnumsStatus::active]);
    }

    /**
     * Retrieves the shipping address data for the currently logged-in user.
     *
     * It first obtains the ID of the authenticated user via a helper function
     * and then uses the repository to fetch all associated addresses based on
     * that user ID.
     *
     * @return \Illuminate\Database\Eloquent\Collection|array The collection of
     * customer shipping address records, or an empty array/collection if none are found.
     */
    public function getCustomerAddressData()
    {
        $userId = UserHelper::getLoggedInUser()->id;
        return $this->customerShippingAddressRepository->getDataOnBasisOfFilter(['user_id' => $userId]);
    }
}
