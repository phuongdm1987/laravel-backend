<?php
declare(strict_types=1);

use Henry\Domain\Category\Category;
use Illuminate\Database\Eloquent\Collection;

if (!function_exists('isCurrentLocale')) {
    /**
     * @param string $locale
     * @return bool
     */
    function isCurrentLocale(string $locale): bool
    {
        return $locale === app()->getLocale();
    }
}

if (!function_exists('generateMenuMultiLevel')) {
    /**
     * @param Collection $menus
     * @param bool $subItem
     * @return string
     */
    function generateMenuMultiLevel(Collection $menus, bool $subItem = false): string
    {
        $html = [];
        $subItemClass = $subItem ? 'navbar-sub-item' : '';

        foreach ($menus as $menu) {
            /** @var Category $menu */
            if ($menu->isLeaf()) {
                $html[] = '<a class="navbar-item">' . $menu->getName() . '</a>';
            } else {
                $html[] = '<div class="navbar-item has-dropdown is-hoverable">';
                $html[] = '<a class="navbar-link">' . $menu->getName() . '</a>';
                $html[] = '<div class="navbar-dropdown ' . $subItemClass . '">';
                $html[] = generateMenuMultiLevel($menu->children, true);
                $html[] = '</div>';
                $html[] = '</div>';
            }
        }

        return $html ? implode('', $html) : '';
    }
}
