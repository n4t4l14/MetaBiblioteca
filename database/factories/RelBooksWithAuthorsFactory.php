<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Author;
use App\Models\Book;
use App\Models\Rel_books_with_authors;
use Faker\Generator as Faker;

$factory->define(Rel_books_with_authors::class, function (Faker $faker) {
    return [
        'book_id' => factory(Book::class),
        'author_id' => factory(Author::class)
    ];
});
