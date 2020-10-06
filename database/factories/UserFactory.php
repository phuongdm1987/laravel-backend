<?php
declare(strict_types=1);

namespace Database\Factories;

use Henry\Domain\User\User;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Str;

/**
 * Class UserFactory
 * @package Database\Factories
 */
class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * @return UserFactory
     */
    public function superAdmin(): UserFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Henry',
                'email' => 'phuongdm1987@gmail.com'
            ];
        });
    }
}
