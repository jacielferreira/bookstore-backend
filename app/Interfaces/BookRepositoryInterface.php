<?php

namespace App\Interfaces;

interface BookRepositoryInterface
{
    public function getBooks();
    public function addBooks(array $book);
    public function deleteBook($bookId);
    public function updateBook($bookId, array $newDetail);
    public function getBookByIsbn($isbnBook);

}
