<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use \Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    $name = $faker->unique()->word(1);
    return [
        'name' => $name,
        'slug' => Str::slug($name),
        'description' => $faker->sentence,
        'status' => 1
    ];
});
