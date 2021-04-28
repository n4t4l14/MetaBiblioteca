<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\BookRepositoryInterface;
use Illuminate\View\View;

/**
 * Class GetBookController
 * @package App\Http\Controllers
 */
class GetBookController
{
    /**
     * @var BookRepositoryInterface
     */
    private $bookRepository;

    /**
     * GetBookController constructor.
     * @param BookRepositoryInterface $bookRepository
     */
    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * @param string $isbn
     * @return View
     */
    public function __invoke(string $isbn): View
    {
        $book = $this->bookRepository->findWithAuthors($isbn);
        return view('book_xml', ['book' => $book]);
    }
}
