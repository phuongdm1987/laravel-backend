<?php
declare(strict_types=1);

namespace App\Providers;

use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\EloquentCategoryRepository;
use App\Repositories\EloquentRepository;
use App\Repositories\RepositoryInterface;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        RepositoryInterface::class => EloquentRepository::class,
        CategoryRepositoryInterface::class => EloquentCategoryRepository::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }
}
