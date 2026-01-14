<?php

namespace App\Domain\Admin\User\Enums;

enum UserEnumsStatus: int
{
    case active = 1;
    case inactive = 0;

    /**
     * Get the label for the category status.
     *
     * @return string The label corresponding to the category status.
     */
    public function label(): string
    {
        return match ($this) {
            self::active => 'Active',
            self::inactive => 'Inactive',
        };
    }
    public function color(): string
    {
        return match ($this) {
            self::active => 'bg-success bg-opacity-10  text-green rounded px-2 py-1 d-inline-flex align-items-center border border-success',
            self::inactive => 'bg-danger bg-opacity-10 text-danger rounded px-2 py-1 d-inline-flex align-items-center border border-danger',
        };
    }
    public function icon(): string
    {
        return match ($this) {
            self::active => 'bi bi-check2-circle',
            self::inactive => 'bi bi-x-circle',
        };
    }
    /**
     * Get all enum cases as an array of options for dropdowns or selects.
     *
     * Each option is represented as an associative array with:
     *  - 'id' => the enum value
     *  - 'label' => a human-readable label for the enum
     *
     * @return array An array of options suitable for form inputs.
     */
    public static function options(): array
    {
        return collect(self::cases())
            ->map(fn($case) => [
                'id' => $case->value,
                'label' => $case->label(),
            ])
            ->toArray();
    }
}
