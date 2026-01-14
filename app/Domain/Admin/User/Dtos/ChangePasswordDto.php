<?php

namespace Domain\Admin\User\Dtos;

class ChangePasswordDto
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public ?string $password = null,
    )
    {}
}
