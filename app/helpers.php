<?php
declare(strict_types=1);

if (! function_exists('isCurrentLocale')) {
    /**
     * @param string $locale
     * @return bool
     */
    function isCurrentLocale(string $locale) {
        return $locale === app()->getLocale();
    }
}
