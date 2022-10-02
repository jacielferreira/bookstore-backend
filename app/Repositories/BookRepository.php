<?php

namespace App\Repositories;

use App\Http\Resources\Book\BookResource;
use App\Interfaces\BookRepositoryInterface;
use App\Models\Book;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class BookRepository implements BookRepositoryInterface
{
    public function __construct(
        private Book $book
    )
    {}

    public function getBooks($total, $currentPage)
    {
        return $this->paginate($total, $currentPage);
    }

    public function addBooks(array $book)
    {
        try{
            $this->book->create($book);
            return response()->json(["message"=> "Book created successfully"], Response::HTTP_CREATED);
        }
        catch (\Throwable $th){
            return response()->json(["message" => $th->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function deleteBook($bookId)
    {
        try{
            $book = $this->book->whereId($bookId)->first();
            $book->delete();
            return response()->json(["message"=> "Book deleted successfully"], Response::HTTP_FOUND);
        }
        catch (\Throwable $th){
            return response()->json(["message" => $th->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function forceDelete($bookId)
    {
        try{
            $book = $this->book->whereId($bookId)->first();
            $book->forceDelete();
            return response()->json(["message"=> "Book removed successfully"], Response::HTTP_CREATED);
        }
        catch (\Throwable $th){
            return response()->json(["message" => $th->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function destroyBook($bookId)
    {
        try{
            $book = $this->book->whereId($bookId)->first();
            $book->destroy($bookId);
            return response()->json(["message"=> "Book removed successfully"], Response::HTTP_CREATED);
        }
        catch (\Throwable $th){
            return response()->json(["message" => $th->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updateBook($bookId, array $newDetail)
    {
        try{
            $book = $this->book->find($bookId);
            $book->update($newDetail);
            return response()->json(["message"=> "Book edited successfully"], Response::HTTP_CREATED);
        }
        catch (\Throwable $th){
            return response()->json(["message" => $th->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getBookByIsbn($isbnBook)
    {
        $books = $this->book->where('isbn', $isbnBook)->paginate(15);
        return response()->json(BookResource::collection($books)
            ->response()->getData(true), Response::HTTP_CREATED);
    }

    public function searchBook($bookName)
    {
        $books = $this->book->where('name', 'like', '%'. $bookName . '%')->paginate(15);
        return response()->json(BookResource::collection($books)
            ->response()->getData(true), Response::HTTP_CREATED);
    }

    public function restoreBook($bookId)
    {
        try{

            $book = $this->book->withTrashed()->where('id', $bookId)->first();
            $book->restore();
            return response()->json(["message"=> "Book restored successfully"], Response::HTTP_CREATED);
        }
        catch (\Throwable $th){
            return response()->json(["message" => $th->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    protected function paginate(int $total, $currentPage)
    {
        $expiration = 60;
        $key = 'book_'.$currentPage;

        return Cache::remember($key, $expiration, function () use ($total) {
            $books = $this->book->with('userBook.user')->paginate(15);
            return response()->json(BookResource::collection($books)->response()->getData(true), Response::HTTP_CREATED);
        });
    }


}
