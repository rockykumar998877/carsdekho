<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class NoHtmlRule implements ValidationRule
{
    /**
     * Validate the attribute value is free from HTML tags.
     *
     * @param  string  $attribute
     * @param  mixed   $value
     * @param  \Closure(string): PotentiallyTranslatedString  $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!is_string($value)) {
            return;
        }
        $cleanAttribute = str_replace('formData.', '', $attribute);
        $cleanAttribute = preg_replace('/\.\d+\./', '.', $cleanAttribute);
        $parts = explode('.', $cleanAttribute);
        $cleanAttribute = end($parts);
        $cleanAttribute = strtolower(str_replace('_', ' ', $cleanAttribute));
        if ($value !== strip_tags($value)) {
            $fail("The {$cleanAttribute} cannot contain HTML tags.");
        }
    }
}
