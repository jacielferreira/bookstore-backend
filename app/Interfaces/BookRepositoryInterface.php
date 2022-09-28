<?php

namespace App\Interfaces;

interface BookRepositoryInterface
{
    public function addBooks(array $book);
    public function getBooks($request);
    public function searchBook($bookName);
    public function updateBook($bookId, array $newDetail);
    public function restoreBook($bookId);
    public function deleteBook($bookId);
    public function destroyBook($bookId);
    public function forceDelete($bookId);
    public function getBookByIsbn($isbnBook);

}
