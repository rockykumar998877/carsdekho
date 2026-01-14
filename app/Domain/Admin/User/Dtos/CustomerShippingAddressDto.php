<?php

namespace Domain\Admin\User\Dtos;

use App\Domain\Admin\User\Enums\UserEnumsStatus;

class CustomerShippingAddressDto
{
    /**
     * Create a new class instance.
     */
    public function __construct(
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
        
    )
    {}
}
