<?php
declare(strict_types=1);

// Home
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('category', function ($trail, $category) {
    if ($category->parent) {
        $trail->parent('category', $category->parent);
    } else {
        $trail->parent('home');
    }

    $trail->push($category->name, route('category.index', $category->slug));
});

Breadcrumbs::for('product', function ($trail, $product) {
    $trail->parent('category', $product->category);

    $trail->push($product->name, route('products.show', $product->slug));
});
