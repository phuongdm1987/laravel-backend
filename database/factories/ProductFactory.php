<?php
declare(strict_types=1);

use Faker\Generator as Faker;

$factory->define(\Henry\Domain\Product\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
        'slug' => $faker->unique()->slug,
        'description' => $faker->paragraph,
        'amount' => $faker->randomDigit,
    ];
});
