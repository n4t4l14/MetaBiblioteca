<?php

namespace App\DTO;

/**
 * Class BookDTO
 * @package App\DTO
 */
class BookDTO
{
    /**
     * @var string
     */
    private $isbn;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $cover_large;

    /**
     * @var AuthorDTO[]
     */
    private $authors = [];

    /**
     * @return string
     */
    public function getIsbn(): string
    {
        return $this->isbn;
    }

    /**
     * @param string $isbn
     */
    public function setIsbn(string $isbn): void
    {
        $this->isbn = $isbn;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getCoverLarge(): string
    {
        return $this->cover_large;
    }

    /**
     * @param string $cover_large
     */
    public function setCoverLarge(string $cover_large): void
    {
        $this->cover_large = $cover_large;
    }

    /**
     * @return AuthorDTO[]
     */
    public function getAuthors(): array
    {
        return $this->authors;
    }

    /**
     * @param AuthorDTO[] $authors
     */
    public function setAuthors(array $authors): void
    {
        $this->authors = $authors;
    }
}
