<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

/**
 * Class BooksListController
 * @package App\Http\Controllers
 */
class BooksListController
{
    /**
     * @return View
     */
    public function __invoke(): View
    {
        return view('home');
    }
}
