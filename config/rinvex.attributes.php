<?php

declare(strict_types=1);

use Henry\Domain\Attribute\Attribute;
use Henry\Domain\AttributeEntity\AttributeEntity;

return [

    // Attributes Database Tables
    'tables' => [

        'attributes' => 'attributes',
        'attribute_entity' => 'attribute_entity',
        'attribute_boolean_values' => 'attribute_boolean_values',
        'attribute_datetime_values' => 'attribute_datetime_values',
        'attribute_integer_values' => 'attribute_integer_values',
        'attribute_text_values' => 'attribute_text_values',
        'attribute_varchar_values' => 'attribute_varchar_values',

    ],

    // Attributes Models
    'models' => [

        'attribute' => Attribute::class,
        'attribute_entity' => AttributeEntity::class,

    ]

];
