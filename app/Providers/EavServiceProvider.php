<?php
declare(strict_types=1);

namespace App\Providers;

use Henry\Domain\Product\Product;
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
class EavServiceProvider extends ServiceProvider
{
    public $bindings = [
        //
    ];

    /**
     * Bootstrap any application services.
     * @return void
     */
    public function boot(): void
    {
        Attribute::typeMap([
            'varchar' => Varchar::class,
            'boolean' => Boolean::class,
            'text' => Text::class,
            'integer' => Integer::class,
        ]);

        app('rinvex.attributes.entities')->push(Product::class);
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
