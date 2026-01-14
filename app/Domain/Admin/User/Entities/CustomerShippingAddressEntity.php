<?php

namespace Domain\Admin\User\Entities;

use App\Domain\Admin\User\Enums\UserEnumsStatus;
use Domain\Admin\User\Dtos\CustomerShippingAddressDto;
use Domain\Admin\User\Models\CustomerShippingAddress;

class CustomerShippingAddressEntity
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public ?int $id,
        public int $user_id,
        public ?string $name = null,
        public ?string $street = null,
        public ?string $city = null,
        public ?string $state = null,
        public ?string $pinCode = null,
        public ?string $country = null,
        public ?int $type = null,
        public ?string $mobile_no = null,
        public ?UserEnumsStatus $status = UserEnumsStatus::active,
    ) {}

    /**
     * function to convert the data array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id'  => $this->id,
            'user_id' => $this->user_id,
            'name' => $this->name,
            'street' => $this->street,
            'city' => $this->city,
            'state' => $this->state,
            'pinCode' => $this->pinCode,
            'country' => $this->country,
            'type' => $this->type,
            'mobile_no' => $this->mobile_no,
            'status' => $this->status,
        ];
    }

    /**
     * Create a new instance of the DTO from a User model.
     *
     * @param CustomerShippingAddress $model The Eloquent User model instance.
     * @return self A new instance of the DTO initialized with model data.
     */
    public static function fromModel(CustomerShippingAddress $model): self
    {
        return new self(
            $model->id,
            $model->user_id,
            $model->name,
            $model->street,
            $model->city,
            $model->state,
            $model->pinCode,
            $model->country,
            $model->type,
            $model->mobile_no,
            UserEnumsStatus::from($model->status->value),
        );
    }

    /**
     * factory method for the CustomerShippingAddressDto dto
     *
     * @param CustomerShippingAddressDto $dto
     * @param integer|null $id
     * @return self
     */
    public static function fromDto(CustomerShippingAddressDto $dto, ?int $id = null): self
    {
        return new self(
            $id,
            $dto->user_id,
            $dto->name,
            $dto->street,
            $dto->city,
            $dto->state,
            $dto->pinCode,
            $dto->country,
            $dto->type,
            $dto->mobile_no,
            UserEnumsStatus::from($dto->status->value),
        );
    }
}
