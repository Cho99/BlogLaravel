<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Models\Tag::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->name,
        'parent_id' => 0,
        'status' => 1,
    ];
});
