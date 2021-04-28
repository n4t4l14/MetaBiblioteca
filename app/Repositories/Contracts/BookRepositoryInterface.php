<?php

namespace App\Repositories\Contracts;

use App\DTO\BookDTO;
use App\Exceptions\BookRepositoryException;
use App\Models\Book;
use Illuminate\Contracts\Pagination\Paginator;

/**
 * Interface BookInterface
 * @package App\Repositories\Contracts
 */
interface BookRepositoryInterface
{
    /**
     * @param BookDTO $bookDTO
     * @return Book
     */
    public function create(BookDTO $bookDTO): Book;

    /**
     * @return Paginator
     */
    public function getPaginate(): Paginator;

    /**
     * @param string $isbn
     * @return Book
     */
    public function findWithAuthors(string $isbn): Book;

    /**
     * @param string $isbn
     * @return bool
     * @throws BookRepositoryException
     */
    public function delete(string $isbn): bool;
}
