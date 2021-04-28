<?php

namespace App\Repositories\Eloquent;

use App\DTO\BookDTO;
use App\Exceptions\BookRepositoryException;
use App\Models\Author;
use App\Models\Book;
use App\Models\Rel_books_with_authors;
use App\Repositories\Contracts\BookRepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class BookRepositoryEloquent
 * @package App\Repositories\Eloquent
 */
class BookRepositoryEloquent implements BookRepositoryInterface
{
    /**
     * @var Book
     */
    private $book;

    /**
     * BookRepositoryEloquent constructor.
     * @param Book $book
     */
    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    /**
     * @param BookDTO $bookDTO
     * @return Book
     */
    public function create(BookDTO $bookDTO): Book
    {
        $this->book->isbn = $bookDTO->getIsbn();
        $this->book->title = $bookDTO->getTitle();
        $this->book->cover_large = $bookDTO->getCoverLarge();

        $this->book->save();

        foreach ($bookDTO->getAuthors() as $authorDTO) {
            $author = new Author();
            $author->name = $authorDTO->getName();
            $author->save();

            $relation = new Rel_books_with_authors();
            $relation->book_id = $this->book->id;
            $relation->author_id = $author->id;
            $relation->save();
        }

        return $this->book;
    }

    /**
     * @return Paginator
     */
    public function getPaginate(): Paginator
    {
        return $this->book->paginate(2);
    }

    /**
     * @param string $isbn
     * @return Book
     */
    public function findWithAuthors(string $isbn): Book
    {
        /** @var Book $book */
        $book = $this->book->where('isbn', '=', $isbn)->first();
        $book->authors = collect();

        // columnas a consultar en la sql
        $columns = [
            DB::raw('authors.id as id'),
            DB::raw('authors.name'),
        ];

        $authors = Author::select($columns)
            ->leftJoin('rel_books_with_authors', 'rel_books_with_authors.author_id', '=', 'authors.id')
            ->where('rel_books_with_authors.book_id', '=', $book->id)
            ->get();

        $authors->each(function (Author $author) use (&$book) {
            $book->authors->push($author);
        });

        return $book;
    }

    /**
     * @param string $isbn
     * @return bool
     * @throws BookRepositoryException
     */
    public function delete(string $isbn): bool
    {
        $book = $this->book->where('isbn', '=', $isbn)->first();

        if (empty($book)) {
            throw new BookRepositoryException("ISBN no encontrado");
        }

        $relBook = Rel_books_with_authors::where('book_id', '=', $book->id);
        $relBook->delete();
        return $book->delete();
    }
}
