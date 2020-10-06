<?php
declare(strict_types=1);

namespace Database\Factories;

use Henry\Domain\Category\Category;
use Illuminate\Database\Eloquent\Factory;

/**
 * Class CategoryFactory
 * @package Database\Factories
 */
class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $types = ['category' => 'category', 'menu' => 'menu'];

        return [
            'name' => $this->faker->unique()->name,
            'slug' => $this->faker->unique()->slug,
            'type' => $this->faker->randomKey($types),
        ];
    }

    /**
     * @return CategoryFactory
     */
    public function category(): CategoryFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'category',
            ];
        });
    }
}
