<?php
declare(strict_types=1);

use Faker\Generator as Faker;

$factory->define(\Henry\Domain\Attribute\Attribute::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name
    ];
});
