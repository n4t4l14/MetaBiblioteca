<?php

namespace App\Providers;

use App\Repositories\Contracts\AuthorRepositoryInterface;
use App\Repositories\Contracts\BookRepositoryInterface;
use App\Repositories\Contracts\OpenLibraryRepositoryInterface;
use App\Repositories\Eloquent\AuthorRepositoryEloquent;
use App\Repositories\Eloquent\BookRepositoryEloquent;
use App\Repositories\OpenLibraryAPI\OpenLibraryRepositoryAPI;
use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 * @package App\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    public $bindings = [
        BookRepositoryInterface::class => BookRepositoryEloquent::class,
        AuthorRepositoryInterface::class => AuthorRepositoryEloquent::class,
        OpenLibraryRepositoryInterface::class => OpenLibraryRepositoryAPI::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
