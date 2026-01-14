<?php

namespace Domain\Admin\User\Actions;

use App\Domain\Admin\User\Enums\UserEnumsStatus;
use Domain\Admin\User\Dtos\CustomerShippingAddressDto;
use Domain\Admin\User\Services\CustomerShippingAddressService;

class CustomerShippingAddressAction
{
    /**
     * Constructor to inject the UserService dependency.
     *
     * @param UserService $service The service responsible for user operations.
     */
    public function __construct(private CustomerShippingAddressService $service){}

    /**
     * Create a new CustomerShippingAddressDto.
     *
     * @param CustomerShippingAddressDto $dto The data transfer object containing CustomerShippingAddress details.
     * @return mixed Returns the created CustomerShippingAddress data or result from the service.
     */
    public function createAction(CustomerShippingAddressDto $dto)
    {
        $dto->status = UserEnumsStatus::active;
        return $this->service->create($dto);
    }

    /**
     * Update an existing CustomerShippingAddress.
     *
     * @param int $id The ID of the CustomerShippingAddress to update.
     * @param CustomerShippingAddressDto $dto The data transfer object containing updated CustomerShippingAddress details.
     * @return mixed Returns the updated CustomerShippingAddress data or result from the service.
     */
    public function updateAction(int $id, CustomerShippingAddressDto $dto)
    {
        return $this->service->update($id, $dto);
    }

    /**
     * List all CustomerShippingAddress.
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
     * @param int $id The ID of the CustomerShippingAddress to delete.
     * @return mixed The result of the delete operation from the service layer.
     */
    public function deleteAction(int $id)
    {
        return $this->service->delete($id);
    }
}
