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

if (!function_exists('generateMenusMultiLevel')) {
    /**
     * @param Collection $menus
     * @param bool $subItem
     * @return string
     */
    function generateMenusMultiLevel(Collection $menus, bool $subItem = false): string
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
                $html[] = generateMenusMultiLevel($menu->children, true);
                $html[] = '</div>';
                $html[] = '</div>';
            }
        }

        return $html ? implode('', $html) : '';
    }
}

if (!function_exists('generateCategoriesMultiLevel')) {
    /**
     * @param Collection $categories
     * @return string
     */
    function generateCategoriesMultiLevel(Collection $categories): string
    {
        $html = [];

        $currentCategory = request()->route()->parameter('category');

        foreach ($categories as $category) {

            $isActive = false;

            if ($currentCategory && $currentCategory->getId() === $category->getId()) {
                $isActive = true;
            }

            $class = 'list-group-item d-flex justify-content-between align-items-center';
            $class .= $isActive ? ' is-active' : '';
            $url = route('category.index', $category->getSlug());

            /** @var Category $category */
            if ($category->isLeaf()) {
                $html[] = '<li class="' . $class . '"><a href="' . $url . '">' . $category->getName() . '</a></li>';
            } else {
                $html[] = '<li class="' . $class . '"><a href="' . $url . '">' . $category->getName() . '</a>';
                $html[] = '<ul>';
                $html[] = generateCategoriesMultiLevel($category->children);
                $html[] = '</ul>';
                $html[] = '</li>';
            }
        }

        return $html ? implode('', $html) : '';
    }
}
