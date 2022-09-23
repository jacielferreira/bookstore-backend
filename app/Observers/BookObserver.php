<?php

namespace App\Observers;

use App\Models\Book;
use App\Models\UserBook;

class BookObserver
{
    public function created(Book $book)
    {
        UserBook::create([
            'user_id' => auth('sanctum')->user()->id,
            'book_id' => $book->id
        ]);
    }
}
