<?php
declare(strict_types=1);

namespace App\Providers;

use App\Observers\AttributeEntityObserver;
use App\Observers\AttributeObserver;
use App\Observers\CategoryObserver;
use App\Observers\ProductObserver;
use Henry\Domain\Attribute\Filters\AttributeFilterInterface;
use Henry\Domain\Attribute\Repositories\AttributeRepositoryInterface;
use Henry\Domain\Attribute\Sorters\AttributeSorterInterface;
use Henry\Domain\AttributeEntity\AttributeEntity;
use Henry\Domain\Category\Category;
use Henry\Domain\Category\Filters\CategoryFilterInterface;
use Henry\Domain\Category\Repositories\CategoryRepositoryInterface;
use Henry\Domain\Category\Sorters\CategorySorterInterface;
use Henry\Domain\Product\Filters\ProductFilterInterface;
use Henry\Domain\Product\Product;
use Henry\Domain\Product\Repositories\ProductRepositoryInterface;
use Henry\Domain\Product\Sorters\ProductSorterInterface;
use Henry\Domain\ProductUser\Filters\ProductUserFilterInterface;
use Henry\Domain\ProductUser\Repositories\ProductUserRepositoryInterface;
use Henry\Domain\ProductUser\Sorters\ProductUserSorterInterface;
use Henry\Domain\User\Filters\UserFilterInterface;
use Henry\Domain\User\Repositories\UserRepositoryInterface;
use Henry\Domain\User\Sorters\UserSorterInterface;
use Henry\Infrastructure\Attribute\Filters\EloquentAttributeFilter;
use Henry\Infrastructure\Attribute\Repositories\EloquentAttributeRepository;
use Henry\Infrastructure\Attribute\Sorters\EloquentAttributeSorter;
use Henry\Infrastructure\Category\Filters\EloquentCategoryFilter;
use Henry\Infrastructure\Category\Repositories\EloquentCategoryRepository;
use Henry\Infrastructure\Category\Sorters\EloquentCategorySorter;
use Henry\Infrastructure\Product\Filters\EloquentProductFilter;
use Henry\Infrastructure\Product\Repositories\EloquentProductRepository;
use Henry\Infrastructure\Product\Sorters\EloquentProductSorter;
use Henry\Infrastructure\ProductUser\Filters\EloquentProductUserFilter;
use Henry\Infrastructure\ProductUser\Repositories\EloquentProductUserRepository;
use Henry\Infrastructure\ProductUser\Sorters\EloquentProductUserSorter;
use Henry\Infrastructure\User\Filters\EloquentUserFilter;
use Henry\Infrastructure\User\Repositories\EloquentUserRepository;
use Henry\Infrastructure\User\Sorters\EloquentUserSorter;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\ServiceProvider;
use Rinvex\Attributes\Models\Attribute;
use Rinvex\Attributes\Models\Type\Boolean;
use Rinvex\Attributes\Models\Type\Integer;
use Rinvex\Attributes\Models\Type\Text;
use Rinvex\Attributes\Models\Type\Varchar;

/**
 * Class AppServiceProvider
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        UserRepositoryInterface::class => EloquentUserRepository::class,
        UserFilterInterface::class => EloquentUserFilter::class,
        UserSorterInterface::class => EloquentUserSorter::class,

        CategoryRepositoryInterface::class => EloquentCategoryRepository::class,
        CategoryFilterInterface::class => EloquentCategoryFilter::class,
        CategorySorterInterface::class => EloquentCategorySorter::class,

        ProductRepositoryInterface::class => EloquentProductRepository::class,
        ProductFilterInterface::class => EloquentProductFilter::class,
        ProductSorterInterface::class => EloquentProductSorter::class,

        ProductUserRepositoryInterface::class => EloquentProductUserRepository::class,
        ProductUserFilterInterface::class => EloquentProductUserFilter::class,
        ProductUserSorterInterface::class => EloquentProductUserSorter::class,

        AttributeRepositoryInterface::class => EloquentAttributeRepository::class,
        AttributeFilterInterface::class => EloquentAttributeFilter::class,
        AttributeSorterInterface::class => EloquentAttributeSorter::class,
    ];

    /**
     * Bootstrap any application services.
     * @return void
     */
    public function boot(): void
    {
        Redis::enableEvents();
        Paginator::defaultView('vendor.pagination.bulma');

        Blade::directive('money', function ($amount) {
            return "<?=number_format($amount, 0, ',', '.')?>";
        });

        Attribute::typeMap([
            'varchar' => Varchar::class,
            'boolean' => Boolean::class,
            'text' => Text::class,
            'integer' => Integer::class,
        ]);

        app('rinvex.attributes.entities')->push(Product::class);

        Product::observe(ProductObserver::class);
        Category::observe(CategoryObserver::class);
        \Henry\Domain\Attribute\Attribute::observe(AttributeObserver::class);
        AttributeEntity::observe(AttributeEntityObserver::class);
    }

    /**
     * Register any application services.
     * @return void
     */
    public function register(): void
    {
        //
    }
}
