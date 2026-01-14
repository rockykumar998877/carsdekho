<?php

namespace Domain\Admin\User\Entities;

use Domain\Admin\User\Dtos\UserDto;
use Domain\Admin\User\Models\User;

class UserEntity
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public ?int $id,
        public string $email,
        public ?string $password = null,
        public ?string $mobile_no = null,
        public ?string $first_name = null,
        public ?string $last_name = null,
        public ?string $gender = null,
        public ?string $status = null,
        public ?string $date_of_birth = null,
        public mixed $image = null,
        public ?int $role = null
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
            'email' => $this->email,
            'mobile_no' => $this->mobile_no,
            'password' => $this->password,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'gender' => $this->gender,
            'status' => $this->status,
            'image' => $this->image,
            'date_of_birth' => $this->date_of_birth,
            'role' => $this->role,
        ];
    }

    /**
     * Create a new instance of the DTO from a User model.
     *
     * @param User $model The Eloquent User model instance.
     * @return self A new instance of the DTO initialized with model data.
     */
    public static function fromModel(User $model): self
    {
        $role = $model->roles->first()?->id;
        return new self(
            $model->id,
            $model->email,
            $model->password,
            $model->mobile_no,
            $model->first_name,
            $model->last_name,
            $model->gender,
            $model->status,
            $model->date_of_birth,
            $model->image,
            $role,
        );
    }

    /**
     * factory method for the user dto
     *
     * @param UserDto $dto
     * @param integer|null $id
     * @return self
     */
    public static function fromDto(UserDto $dto, ?int $id = null): self
    {
        return new self(
            $id,
            $dto->email,
            $dto->password,
            $dto->mobile_no,
            $dto->first_name,
            $dto->last_name,
            $dto->gender,
            $dto->status,
            $dto->date_of_birth,
            $dto->image,
            $dto->role
        );
    }
}
