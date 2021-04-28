<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'isbn' => $faker->e164PhoneNumber,
        'title' => $faker->title,
        'cover_large' => $faker->url,
    ];
});
