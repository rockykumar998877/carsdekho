<?php

namespace Domain\Admin\User\Dtos;

use App\Domain\Admin\User\Enums\UserEnumsStatus;

class UserDto
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public string $email,
        public ?string $password = null,
        public ?string $mobile_no = null,
        public ?string $first_name = null,
        public ?string $last_name = null,
        public ?string $gender = null,
        public ?int $status = null,
        public ?string $date_of_birth = null,
        public mixed $image = null,
        public ?string $role = null,
        
    )
    {}
}
