<?php

namespace Domain\Admin\User\Entities;

use Domain\Admin\User\Dtos\RoleDto;
use Domain\Admin\User\Models\Role;

class RoleEntity
{
    /**
     * RoleEntity constructor.
     *
     * @param int|null $id           The ID of the role (null for new roles).
     * @param string   $name         The name of the role.
     * @param array    $parents      IDs of parent permissions.
     * @param array    $children     IDs of child permissions.
     * @param array    $permissions  Combined list of permission IDs (parents + children).
     */
    public function __construct(
        public ?int $id,
        public string $name,
        public array $parents = [],
        public array $children = [],
        public array $permissions = [],
        public ?int $customerId = null,
        public ?string $created_at = null,
        public ?string $updated_at = null
    ) {
    }

    /**
     * Convert RoleEntity instance into an array.
     *
     * Useful for persisting role data in repositories or serializing for APIs.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'parents' => $this->parents,
            'children' => $this->children,
            'permissions' => $this->permissions,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }

    /**
     * Create a RoleEntity instance from an Eloquent Role model.
     *
     * This allows converting database records into a domain entity.
     *
     * @param Role $model
     * @return self
     */
    public static function fromModel(Role $model): self
    {
        return new self(
            $model->id,
            $model->name,
            $model->permissions?->whereNull('parent_id')->pluck('id')->toArray() ?? [],
            $model->permissions?->whereNotNull('parent_id')->pluck('id')->toArray() ?? [],
            $model->permissions?->pluck('id')->toArray() ?? [],
            null,
            $model->created_at,
            $model->updated_at,
        );
    }

    /**
     * Create a RoleEntity instance from a RoleDto.
     *
     * Combines parents and children into the permissions property.
     * Useful when handling form submissions or service-layer transformations.
     *
     * @param RoleDto   $dto Data transfer object representing role input.
     * @param int|null  $id  Optional role ID (for updates).
     * @return self
     */
    public static function fromDto(RoleDto $dto, ?int $id = null): self
    {
        $parents = $dto->parents ?? [];
        $children = $dto->children ?? [];
        $permissions = array_merge($parents, $children);
        return new self(
            $id,
            $dto->name,
            $dto->parents,
            $dto->children,
            $permissions,
            null,
            $dto->created_at,
            $dto->updated_at
        );
    }
}
