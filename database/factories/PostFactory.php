<?php

use Faker\Generator as Faker;
use App\Post;
use App\User;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'body' => $faker->sentence,
        'user_id' => User::inRandomOrder()->first()->id,
    ];
});
