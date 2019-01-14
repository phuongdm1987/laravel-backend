<?php
declare(strict_types=1);

use Faker\Generator as Faker;

$factory->define(\Henry\Domain\Category\Category::class, function (Faker $faker) {
    $types = ['category' => 'category', 'menu' => 'menu'];
    return [
        'name' => $faker->unique()->name,
        'slug' => $faker->unique()->slug,
        'type' => $faker->randomKey($types),
    ];
});

$factory->state(\Henry\Domain\Category\Category::class, 'category', [
    'type' => 'category',
]);
