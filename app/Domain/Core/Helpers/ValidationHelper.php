<?php

namespace App\Domain\Core\Helpers;

use App\Rules\NoHtmlRule;
use Illuminate\Validation\Rule;
use NodeSpace\CommonHelpers\Helpers\ValidationHelper as BaseValidationHelper;

class ValidationHelper extends BaseValidationHelper
{
    /**
     * function for the validation rule for first name
     *
     * @return string
     */
    public static function descriptionValidationRule(): string
    {
        return 'nullable|string';
    }

    /**
     * function for the id validation rule
     *
     * @param string $table
     * @param string $column
     * @return string
     */
    public static function idExistsValidationRule(string $table, string $column = 'id', bool $required = true): string
    {
        $prefix = $required ? 'required' : 'nullable';
        return "{$prefix}|exists:{$table},{$column}";
    }

    /**
     * function for the unique validation rule
     *
     * @param string $table
     * @param string $column
     * @return string
     */

    public static function uniqueValidationRule(string $table, string $column = 'id', bool $required = true, $ignoreId = null): array
    {
        $rule = Rule::unique($table, $column);
        if ($ignoreId) {
            $rule = $rule->ignore($ignoreId);
        }
        return [
            $required ? 'required' : 'nullable',
            $rule,
            new NoHtmlRule()
        ];
    }



    /**
     * Get the validation rule for status field.
     *
     * @param bool $required
     * @return array
     */
    public static function statusValidationRule(bool $required = true, string $class): array
    {
        return [
            $required ? 'required' : 'nullable',
            Rule::enum($class),
        ];
    }

    /**
     * Get the validation rule for filterable field.
     *
     * @param bool $required
     * @return array
     */
    public static function isFilterable(bool $required = true): array
    {
        return [
            $required ? 'required' : 'nullable',
        ];
    }

    /**
     * function for the validation rule for amount
     */
    public static function amountValidationRule(): string
    {
        return 'numeric|min:0';
    }

    /**
     * function for the validation rule for image order
     */
    public static function orderValidationRule(): string
    {
        return 'required|numeric|min:0';
    }

    /**
     * function for the validation rule for date validation
     *
     * @return string
     */
    public static function dateValidationRule($required = true): string
    {
        $prefix = $required ? 'required' : 'nullable';
        return "{$prefix}|date";
    }

    /**
     * Get the validation rule for price.
     *
     * Ensures that the price field is:
     * - Required
     * - Numeric
     * - Greater than or equal to 0
     *
     * @return string
     */
    public static function priceValidationRule($required = true): string
    {
        $prefix = $required ? 'required' : 'nullable';
        return "{$prefix}|numeric|min:0|max:9999999.99";
    }

    /**
     * Get the validation rule for quantity.
     *
     * Ensures the quantity is:
     * - Required
     * - An integer value
     * - Minimum 0 (no negative values allowed)
     * - Maximum 999999 (adjustable as per business logic)
     *
     * @return string
     */
    public static function quantityValidationRule($required = true): string
    {
        $prefix = $required ? 'required' : 'nullable';
        return "{$prefix}|integer|min:0|max:999999";
    }

    /**
     * function for the validation rule for sku
     *
     * @return string
     */
    public static function skuValidationRule($required = true): string
    {
        $prefix = $required ? 'required' : 'nullable';
        return "{$prefix}|max:150|string";
    }

    /**
     * function for the image validation rule
     *
     * @return string
     */
    public static function imageValidationRule(): string
    {
        return 'image|mimes:jpeg,png,jpg|max:2048';
    }

    /**
     * function for the batch number validation rule
     *
     * @return string
     */

    public static function batchNumberValidationRule($required = false): string
    {
        $prefix = $required ? 'required' : 'nullable';
        return "{$prefix}|alpha_num|max:10";
    }

    /**
     * Returns a validation rule for validating a phone number.
     *
     * The rule ensures that:
     * 1. The field can be required or nullable (based on parameter).
     * 2. The phone number must be between 10 to 12 digits.
     * 3. It must be unique in the specified table and column.
     *
     * @param string $table   The database table name for uniqueness validation.
     * @param string $column  The column name to check uniqueness against (default: 'mobile_no').
     * @param bool   $required Whether the field is required (default: false).
     *
     * @return string The validation rule string.
     */
    public static function phoneNoValidationRule(string $table, string $column = 'mobile_no', bool $required = false): string
    {
        $prefix = $required ? 'required' : 'nullable';
        return "{$prefix}|digits_between:10,12|unique:{$table},{$column}";
    }

    /**
     * Returns the validation rule for a PIN code.
     *
     * The rule ensures that:
     * 1. The field is required.
     * 2. The PIN code is exactly 6 digits long.
     * 3. The first digit is between 1-9 (i.e., cannot start with 0).
     *
     * @return string The validation rule for a PIN code.
     */
    public static function pinCodeValidationRule()
    {
        return 'required|regex:/^[1-9][0-9]{5}$/|digits:6';
    }

    /**
     * function for the forgot email validation rule
     *
     * @return string
     */
    public static function forgotEmailValidationRule(): string
    {
        return 'required|email';
    }

    /**
     * function for the reset password validation rule
     *
     * @return string
     */
    public static function resetPasswordValidationRule(): string
    {
        return 'required|min:8|confirmed';
    }

    /**
     * Merge given validation rules with NoHtmlRule.
     *
     * @param  string|array  $rules  Validation rules as string ("required|string")
     *                               ya array (['required', 'string'])
     * @return array                 Final rules including NoHtmlRule
     */
    public static function mergeNoHtmlRule(string|array $rules): array
    {
        $rules = is_array($rules) ? $rules : explode('|', $rules);
        $rules[] = new NoHtmlRule();
        return $rules;
    }
}
