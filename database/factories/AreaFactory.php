<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Area;
use Faker\Generator as Faker;

$factory->define(Area::class, function (Faker $faker) {
    return [
        'name' => $faker->city,
        'division_id' => mt_rand(1, 6),
        'district_id' => mt_rand(1, 64),
        'upazila_id' => mt_rand(1, 491),
    ];
});
