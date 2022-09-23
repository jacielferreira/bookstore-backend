<?php

namespace App\Services\Api;

use App\Models\Book;
use App\Repositories\BookRepository;
use Illuminate\Http\Request;

class BookService
{
    public function __construct(
        protected BookRepository $bookRepository
    )
    {}

    public function addBook(Request $request)
    {
        $attributes = $request->all();
        $this->bookRepository->addBook($attributes);
    }

    public function getBooks()
    {
        $this->bookRepository->getBooks();
    }
}
