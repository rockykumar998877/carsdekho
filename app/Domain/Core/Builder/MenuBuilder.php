<?php

namespace Domain\Core\Builder;

use NodeSpace\CommonHelpers\Helpers\UserHelper;

class MenuBuilder
{

    /**
     * function to build the menu item
     *
     * @param array $menu
     * @param array $flags
     * @return array
     */
    public static function build(array $menu, array $flags = []): array
    {
        return collect($menu)
            ->map(fn ($item) => self::filterItem($item, $flags))
            ->filter() // remove nulls
            ->values()
            ->all();
    }

    /**
     * function to filter the item
     *
     * @param array $item
     * @param array $flags
     * @return array|null
     */
    protected static function filterItem(array $item, array $flags): ?array
    {
        $userData = UserHelper::getLoggedInUser();
        // Check feature flag
        if (isset($item['feature_flag'])) {
            $flag = $item['feature_flag'];
            if (!($flags[$flag] ?? false)) {
                return null;
            }
        }

        // Permission check (if defined)
        if (!empty($item['permission']) && !$userData->can($item['permission'])) {
            return null;
        }

        // Process children
        if (!empty($item['children']) && is_array($item['children'])) {
            $children = collect($item['children'])
                ->map(fn($child) => self::filterItem($child, $flags))
                ->filter()
                ->values()
                ->all();

            if (empty($children) && empty($item['route'])) {
                return null;
            }

            $item['children'] = $children;
        }

        // Apply translations to labels
        $item['label'] = __($item['label']);

        return $item;
    }

}
