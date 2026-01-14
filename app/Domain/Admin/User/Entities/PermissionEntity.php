<?php

namespace Domain\Admin\User\Entities;

use Domain\Admin\User\Dtos\PermissionDto;
use Domain\Admin\User\Models\Permission;

class PermissionEntity
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public ?int $id,
        public string $name,
        public ?int $parent_id,
        public array $roots = [],
        public ?string $created_at = null,
        public ?string $updated_at = null
    )
    {}

    /**
     * function to convert the data array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'parent_id'   => $this->parent_id,
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at
        ];
    }

    /**
     * factory method for the Permission model
     *
     * @param Permission $model
     * @return self
     */
    public static function fromModel(Permission $model): self
    {
        return new self(
            $model->id,
            $model->name,
            $model->parent_id,
            $model->rootParents()->toArray(),
            $model->created_at,
            $model->updated_at
        );
    }

    /**
     * factory method for the Permission dto
     *
     * @param PermissionDto $dto
     * @param integer|null $id
     * @return self
     */
    public static function fromDto(PermissionDto $dto, ?int $id = null): self
    {
        return new self(
            $id,
            $dto->name,
            $dto->parent_id,
        );
    }
}
