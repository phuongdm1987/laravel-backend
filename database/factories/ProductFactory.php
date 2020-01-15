<?php
declare(strict_types=1);

use Faker\Generator as Faker;

$factory->define(\Henry\Domain\Product\Product::class, function (Faker $faker) {
    return [
        $faker->unique()->name,
        $faker->unique()->slug,
        $faker->unique()->name,
        $faker->unique()->name,
    ];
});
