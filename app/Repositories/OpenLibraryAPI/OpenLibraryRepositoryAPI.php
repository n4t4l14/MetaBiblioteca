<?php

namespace App\Repositories\OpenLibraryAPI;

use App\DTO\AuthorDTO;
use App\DTO\BookDTO;
use App\Exceptions\OpenLibraryRepositoryException;
use App\Repositories\Contracts\OpenLibraryRepositoryInterface;
use GuzzleHttp\Client;

/**
 * Class OpenLibraryRepositoryAPI
 * @package App\Repositories\OpenLibraryAPI
 */
class OpenLibraryRepositoryAPI implements OpenLibraryRepositoryInterface
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @inheritDoc
     */
    public function find(string $isbn): BookDTO
    {
        $key = 'ISBN:' . $isbn;
        $url = 'https://openlibrary.org/api/books?bibkeys=ISBN:%s&jscmd=data&format=json';
        $url = sprintf($url, $isbn);

        $response = $this->client->get($url);
        $data = json_decode($response->getBody()->getContents(), true);

        if (empty($data)) {
            $msg = 'No se encontro ningún libro con el isbn ' . $isbn;
            throw new OpenLibraryRepositoryException($msg);
        }

        $bookDTO = new BookDTO();
        $bookDTO->setIsbn($isbn);
        $bookDTO->setTitle($data[$key]['title']);
        $bookDTO->setCoverLarge($data[$key]['cover']['large'] ?? 'http://undefined.com');

        $authors = [];
        foreach ($data[$key]['authors'] as $authorData) {
            $authorDTO = new AuthorDTO();
            $authorDTO->setName($authorData['name']);

            $authors[] = $authorDTO;
        }

        $bookDTO->setAuthors($authors);

        return $bookDTO;
    }
}
