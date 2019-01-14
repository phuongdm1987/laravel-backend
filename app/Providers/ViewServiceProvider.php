<?php
declare(strict_types=1);

namespace App\Providers;

use App\Http\View\Composers\CategoryComposer;
use App\Http\View\Composers\MenuComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

/**
 * Class ViewServiceProvider
 * @package App\Providers
 */
class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        view()->composer(
            ['commons.header'], MenuComposer::class
        );

        view()->composer(
            ['commons.side-bar'], CategoryComposer::class
        );
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }
}
