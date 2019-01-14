<?php
declare(strict_types=1);

use Illuminate\Database\Seeder;

/**
 * Class CategoriesTableSeeder
 */
class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        factory(\Henry\Domain\Category\Category::class, 10)
            ->create()
            ->each(function ($category) {
                /** @var \Henry\Domain\Category\Category $category */
                if ($category->isTypeCategory()) {
                    $category->products()
                        ->saveMany(factory(\Henry\Domain\Product\Product::class, 5)->make());
                }
            });
    }
}
