<?php

namespace App\Http\Controllers;

use App\Exceptions\BookRepositoryException;
use App\Repositories\Contracts\BookRepositoryInterface;
use http\Client\Response;
use Illuminate\Http\JsonResponse;

/**
 * Class DeleteBookController
 * @package App\Http\Controllers
 */
class DeleteBookController
{
    /**
     * @param string $isbn
     * @param BookRepositoryInterface $bookRepository
     */
    public function __invoke(string $isbn, BookRepositoryInterface $bookRepository): JsonResponse
    {
        try {
            $bookDelete = $bookRepository->delete($isbn);
            if (!$bookDelete) {
                return response()->json(['error' => 'No se pudo eliminar el libro'], 503);
            }
        } catch (BookRepositoryException $exception) {
            return response()->json([
               'error' => $exception->getMessage()
            ]);
        }

        return Response()->json(['message' => 'Registro eliminado con éxito']);
    }
}
