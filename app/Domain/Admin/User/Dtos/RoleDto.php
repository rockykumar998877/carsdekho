<?php

namespace Domain\Admin\User\Dtos;

class RoleDto
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public string $name,
        public ?array $parents = null,
        public ?array $children = null,
        public ?array $permissions = null,
        public ?string $created_at = null,
        public ?string $updated_at = null
    ) {
    }
}
