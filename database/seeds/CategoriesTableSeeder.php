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
                    $category->attributes()
                        ->saveMany(factory(\Henry\Domain\Attribute\Attribute::class, 5)->create()
                        ->each(function ($attribute) use ($category) {
                            /** @var \Henry\Domain\Attribute\Attribute $attribute */
                            $attribute->attributeValues()
                                ->saveMany(factory(\Henry\Domain\AttributeValue\AttributeValue::class, 5)->create()
                                ->each(function ($attributeValue) use ($category) {
                                    $attributeValue->products()
                                        ->saveMany(factory(\Henry\Domain\Product\Product::class, 5)->make([
                                            'category_id' => $category->id
                                        ]));
                                }));
                        }));
                }
            });
    }
}
