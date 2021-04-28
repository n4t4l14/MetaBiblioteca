<?php

namespace App\Http\Controllers;

use App\Exceptions\OpenLibraryRepositoryException;
use App\Http\Resources\BookResource;
use App\Repositories\Contracts\BookRepositoryInterface;
use App\Repositories\Contracts\OpenLibraryRepositoryInterface;
use App\Repositories\OpenLibraryAPI\OpenLibraryRepositoryAPI;
use Illuminate\Http\JsonResponse;

/**
 * Class CreateBookController
 * @package App\Http\Controllers
 */
class CreateBookController
{
    /**
     * @var BookRepositoryInterface
     */
    private $bookRepository;

    /**
     * @var OpenLibraryRepositoryInterface
     */
    private $libraryRepository;

    /**
     * CreateBookController constructor.
     * @param BookRepositoryInterface $bookRepository
     * @param OpenLibraryRepositoryInterface $libraryRepository
     */
    public function __construct(
        BookRepositoryInterface $bookRepository,
        OpenLibraryRepositoryInterface $libraryRepository
    ) {
        $this->bookRepository = $bookRepository;
        $this->libraryRepository = $libraryRepository;
    }

    /**
     * @param string $isbn
     * @return JsonResponse
     */
    public function __invoke(string $isbn): JsonResponse
    {
        try {
            $bookDTO = $this->libraryRepository->find($isbn);
            $book = $this->bookRepository->create($bookDTO);
        } catch (OpenLibraryRepositoryException $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ]);
        }

        return (new BookResource($book))->response();
    }

}
