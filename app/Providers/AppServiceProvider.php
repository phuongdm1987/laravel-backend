<?php
declare(strict_types=1);

namespace App\Providers;

use Henry\Domain\Category\Filters\CategoryFilterInterface;
use Henry\Domain\Category\Repositories\CategoryRepositoryInterface;
use Henry\Domain\Product\Filters\ProductFilterInterface;
use Henry\Domain\Product\Repositories\ProductRepositoryInterface;
use Henry\Domain\User\Filters\UserFilterInterface;
use Henry\Domain\User\Repositories\UserRepositoryInterface;
use Henry\Infrastructure\Category\Filters\EloquentCategoryFilter;
use Henry\Infrastructure\Category\Repositories\EloquentCategoryRepository;
use Henry\Infrastructure\Product\Filters\EloquentProductFilter;
use Henry\Infrastructure\Product\Repositories\EloquentProductRepository;
use Henry\Infrastructure\User\Filters\EloquentUserFilter;
use Henry\Infrastructure\User\Repositories\EloquentUserRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        UserRepositoryInterface::class => EloquentUserRepository::class,
        UserFilterInterface::class => EloquentUserFilter::class,

        CategoryRepositoryInterface::class => EloquentCategoryRepository::class,
        CategoryFilterInterface::class => EloquentCategoryFilter::class,

        ProductRepositoryInterface::class => EloquentProductRepository::class,
        ProductFilterInterface::class => EloquentProductFilter::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Paginator::defaultView('vendor.pagination.bulma');
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
