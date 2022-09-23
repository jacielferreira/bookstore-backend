<?php

namespace App\Services\Api;

use App\Models\Book;

class BookService
{
    public function addNewBook($books)
    {
        return Book::create($books);
    }

    public function getBooks(array $params = [])
    {
        return Book::all();
    }
}
