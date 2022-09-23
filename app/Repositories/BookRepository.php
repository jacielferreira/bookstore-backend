<?php

namespace App\Repositories;

use App\Models\Book;

class BookRepository
{
    public function __construct(
        protected Book $book
    )
    {}

    public function addBook(array $attributes)
    {
        return $this->book->create($attributes);
    }

    public function getBooks()
    {
        return $this->book->all();
    }


}
