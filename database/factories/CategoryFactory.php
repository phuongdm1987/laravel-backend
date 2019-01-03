<?php
declare(strict_types=1);

use Faker\Generator as Faker;

$factory->define(\App\Entities\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
        'slug' => $faker->unique()->slug,
    ];
});
