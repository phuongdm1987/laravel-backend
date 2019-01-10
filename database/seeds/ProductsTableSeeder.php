<?php
declare(strict_types=1);

use Illuminate\Database\Seeder;

/**
 * Class ProductsTableSeeder
 */
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        factory(\Henry\Domain\Product\Product::class, 50)->create();
    }
}
