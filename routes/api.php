<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/books/create/{isbn}', [
    'as' => 'api.create.book',
    'uses' => 'CreateBookController'
]);

Route::get('/books', [
    'as' => 'api.get.books',
    'uses' => 'GetBooksController'
]);

Route::get('/books/{isbn}', [
    'as' => 'api.get.book',
    'uses' => 'GetBookController'
]);

Route::post('/books/{isbn}/delete', [
    'as' => 'api.delete.book',
    'uses' => 'DeleteBookController',
]);

