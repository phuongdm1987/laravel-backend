<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;

/**
 * Class LanguageController
 * @package App\Http\Controllers
 */
class LanguageController extends Controller
{
    /**
     * @param $locale
     * @return RedirectResponse
     */
    public function update($locale): RedirectResponse
    {
        $locales = config('language', []);

        if (Arr::has($locales, $locale)) {
            session(['locale' => $locale]);
        }

        return redirect()->back();
    }
}
