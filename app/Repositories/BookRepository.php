<?php

namespace App\Repositories;

use App\Interfaces\BookRepositoryInterface;
use App\Models\Book;

class BookRepository implements BookRepositoryInterface
{
    public function __construct(
        protected Book $book
    )
    {}

    public function getBooks()
    {
        return $this->book->all();
    }

    public function addBooks(array $book)
    {
        return $this->book->create($book);
    }

    public function deleteBook($bookId)
    {
        $this->book->destroy($bookId);
    }

    public function updateBook($bookId, array $newDetail)
    {
        $this->book->whereId($bookId)->update($newDetail);
    }

    public function getBookByIsbn($isbnBook)
    {
        $this->book->where('isbn', $isbnBook)->get();
    }
}
