<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookCollection;
use App\Repositories\Contracts\BookRepositoryInterface;
use Illuminate\Http\JsonResponse;

/**
 * Class GetBooksController
 * @package App\Http\Controllers
 */
class GetBooksController
{
    /**
     * @var BookRepositoryInterface
     */
    private $bookRepository;

    /**
     * GetBooksController constructor.
     * @param BookRepositoryInterface $bookRepository
     */
    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $data = $this->bookRepository->getPaginate();
        return (new BookCollection($data))->response();
    }
}
