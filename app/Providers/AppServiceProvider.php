<?php
declare(strict_types=1);

namespace App\Providers;

use Henry\Domain\Category\Repositories\CategoryRepositoryInterface;
use Henry\Infrastructure\Category\Repositories\EloquentCategoryRepository;
use Henry\Infrastructure\EloquentRepository;
use Henry\Domain\RepositoryInterface;
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
