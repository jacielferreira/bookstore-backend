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

    public function updated(Book $book)
    {
        $book->userBook->update([
            'user_id' => $book->userBook->user_id,
            'book_id' => $book->id,
            'updated_by' => auth('sanctum')->user()->id,
        ]);
    }

    public function deleted(Book $book)
    {
        $book->deleted_by = auth('sanctum')->user()->id;
        $book->update();
        $book->userBook->deleted_by = auth('sanctum')->user()->id;
        $book->userBook->update();
        $book->userBook->delete();
    }

    public function restoring(Book $book)
    {
        $book->userBook()
            ->withTrashed()
            ->get()
            ->each(function ($userBook){
                $userBook->restore();
            });
    }

    public function restored(Book $book)
    {
        $book->deleted_by = null;
        $book->userBook->deleted_by = null;
        $book->userBook->update();
        $book->update();
    }
}
