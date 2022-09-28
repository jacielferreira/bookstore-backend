<?php

namespace App\Interfaces;

interface BookRepositoryInterface
{
    public function addBooks(array $book);
    public function getBooks($request);
    public function updateBook($bookId, array $newDetail);
    public function restoreBook($book);
    public function deleteBook($book);
    public function forceDelete($book);
    public function getBookByIsbn($isbnBook);

}
