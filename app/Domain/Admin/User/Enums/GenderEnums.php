<?php

namespace App\Domain\Admin\User\Enums;

enum GenderEnums: int
{
    case male = 1;
    case female = 2;
    case other = 3;

    /**
     * Get the label for the category status.
     *
     * @return string The label corresponding to the category status.
     */
    public function label(): string
    {
        return match ($this) {
            self::male => 'Male',
            self::female => 'Female',
            self::other => 'Others'
        };
    }
    public function color(): string
    {
        return match ($this) {
            self::male => 'text-green fw-semibold',
            self::female => 'text-dark-pink fw-semibold',
            self::other => 'text-danger fw-semibold',
        };
    }

}
