<?php
declare(strict_types=1);

namespace Database\Factories;

use Henry\Domain\Product\Product;
use Illuminate\Database\Eloquent\Factory;

/**
 * Class ProductFactory
 * @package Database\Factories
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->name,
            'slug' => $this->faker->unique()->slug,
            'description' => $this->faker->paragraph,
            'amount' => $this->faker->randomDigit,
        ];
    }
}
