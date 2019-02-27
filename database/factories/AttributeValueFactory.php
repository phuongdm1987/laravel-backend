<?php
declare(strict_types=1);

use Faker\Generator as Faker;

$factory->define(\Henry\Domain\AttributeValue\AttributeValue::class, function (Faker $faker) {
    return [
        'value' => $faker->name,
        'amount' => $faker->randomDigitNotNull
    ];
});
