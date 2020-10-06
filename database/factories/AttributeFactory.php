<?php
declare(strict_types=1);

namespace Database\Factories;

use Exception;
use Henry\Domain\Attribute\Attribute;
use Illuminate\Database\Eloquent\Factory;

/**
 * Class AttributeFactory
 * @package Database\Factories
 */
class AttributeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Attribute::class;

    /**
     * @return array
     * @throws Exception
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->name,
            'is_filter' => random_int(0, 1),
        ];
    }
}
