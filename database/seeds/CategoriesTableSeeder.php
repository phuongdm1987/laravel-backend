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
     * @return void
     * @throws Exception
     */
    public function run(): void
    {


        $categories = factory(\Henry\Domain\Category\Category::class, 10)->create();

        foreach ($categories as$category) {
            /** @var \Henry\Domain\Category\Category $category */
            if ($category->isTypeCategory()) {
                $attributes = factory(\Henry\Domain\Attribute\Attribute::class, 5)->create();

                foreach ($attributes as $attribute) {
                    /** @var \Henry\Domain\Attribute\Attribute $attribute */
                    $attribute->categories()->sync([$category->getId()]);
                }

                $attributeIds = $attributes->pluck('id');

                $attributeValues = factory(\Henry\Domain\AttributeValue\AttributeValue::class, 5)->create([
                    'attribute_id' => $attributeIds->random()
                ]);

                $products = factory(\Henry\Domain\Product\Product::class, 5)->create([
                    'category_id' => $category->getId()
                ]);

                $syncData = [];
                foreach ($attributeValues as $attributeValue) {
                    /** @var \Henry\Domain\AttributeValue\AttributeValue $attributeValue */
                    $syncData[$attributeValue->getId()] = [
                        'amount' => random_int(0, 100000000),
                        'attribute_id' => $attributeValue->getAttributeId()
                    ];
                }

                foreach ($products as $product) {
                    /** @var \Henry\Domain\Product\Product $product */
                    $product->attributeValues()->sync($syncData);
                }
            }
        }
    }
}
