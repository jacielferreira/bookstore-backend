<?php

namespace App\Interfaces;

interface BookRepositoryInterface
{
    public function getBooks();
    public function addBooks(array $book);
}
