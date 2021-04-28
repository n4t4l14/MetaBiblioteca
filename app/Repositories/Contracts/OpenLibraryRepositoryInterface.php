<?php

namespace App\Repositories\Contracts;

use App\DTO\BookDTO;

/**
 * Interface OpenLibraryRepositoryInterface
 * @package App\Repositories\Contracts
 */
interface OpenLibraryRepositoryInterface
{
    /**
     * @param string $isbn
     * @return BookDTO
     */
    public function find(string $isbn): BookDTO;
}
