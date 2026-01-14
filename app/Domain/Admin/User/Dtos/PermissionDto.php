<?php

namespace Domain\Admin\User\Dtos;

class PermissionDto
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public string $name,
        public ?int $parent_id = null,
        public ?string $created_at = null,
        public ?string $updated_at = null
    )
    {}
}
