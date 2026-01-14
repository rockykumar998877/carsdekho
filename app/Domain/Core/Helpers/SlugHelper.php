<?php

namespace App\Domain\Core\Helpers;

use Illuminate\Support\Str;

class SlugHelper
{
    /**
     * function to generate slug from string
     *
     * @param string $value
     * @return string
     */
    public static function slug($value): string
    {
        return Str::slug($value);
    }
}
