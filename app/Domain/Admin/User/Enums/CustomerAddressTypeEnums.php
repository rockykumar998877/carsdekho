<?php

namespace App\Domain\Admin\User\Enums;

enum CustomerAddressTypeEnums: int
{
    case personal = 1;
    case work = 2;
    case friend = 3;
    case other = 4;

    /**
     * Get the label for the address type.
     *
     * @return string The label corresponding to the address type.
     */
    public function label(): string
    {
        return match ($this) {
            self::personal => 'Personal',
            self::work => 'Work',
            self::friend => 'Friend',
            self::other => 'Other',
        };
    }
    public function color(): string
    {
        return match ($this) {
            self::personal => 'bg-primary bg-opacity-10 text-primary border border-primary rounded px-2 py-1 d-inline-flex align-items-center',
            self::work => 'bg-warning bg-opacity-10 text-warning border border-warning rounded px-2 py-1 d-inline-flex align-items-center',
            self::friend => 'bg-success bg-opacity-10 text-success border border-success rounded px-2 py-1 d-inline-flex align-items-center',
            self::other => 'bg-secondary bg-opacity-10 text-secondary border border-secondary rounded px-2 py-1 d-inline-flex align-items-center',
        };
    }
    public function icon(): string
    {
        return match ($this) {
            self::personal => 'bi bi-person',
            self::work => 'bi bi-briefcase',
            self::friend => 'bi bi-people',
            self::other => 'bi bi-stars',
        };
    }


    /**
     * Get all enum cases as an array of options for dropdowns or selects.
     *
     * Each option is represented as:
     *  - 'id' => the enum value
     *  - 'label' => a human-readable label for the enum
     *
     * @return array<int, array{id: int, label: string}>
     */
    public static function options(): array
    {
        return collect(self::cases())
            ->map(fn(self $case) => [
                'id' => $case->value,
                'label' => $case->label(),
            ])
            ->toArray();
    }
}
