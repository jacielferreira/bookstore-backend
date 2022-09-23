<?php

namespace App\Services\Api;

use App\Models\Book;

class BookService
{
    public function addBook($book)
    {
        $book = Book::create($book);
        return response()->json(['message'=>'Book created!', "data" => $book], 200);
    }

    public function getBooks(array $params = [])
    {
        return Book::all();
    }
}
