<?php
declare(strict_types=1);

namespace Database\Factories;

use Henry\Domain\AttributeValue\AttributeValue;
use Illuminate\Database\Eloquent\Factory;

/**
 * Class AttributeValueFactory
 * @package Database\Factories
 */
class AttributeValueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AttributeValue::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'value' => $this->faker->name,
        ];
    }
}
