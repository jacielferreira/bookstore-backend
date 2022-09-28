<?php

namespace App\Repositories;

use App\Http\Resources\Book\BookResource;
use App\Interfaces\BookRepositoryInterface;
use App\Models\Book;
use Symfony\Component\HttpFoundation\Response;

class BookRepository implements BookRepositoryInterface
{
    public function __construct(
        private Book $book
    )
    {}

    public function getBooks($request)
    {
        $books = $this->book->with('userBook.user')->paginate(15);
        return response()->json(BookResource::collection($books)->response()->getData(true), Response::HTTP_CREATED);
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
            return response()->json(["message"=> "Book deleted successfully"], Response::HTTP_CREATED);
        }
        catch (\Throwable $th){
            return response()->json(["message" => $th->getMessage()], Response::HTTP_NOT_FOUND);
        }
    }

    public function forceDelete($bookId)
    {

    }

    public function updateBook($bookId, array $newDetail)
    {
        try{
            $book = $this->book->find($bookId);
            $book->update($newDetail);
            return response()->json(["message"=> "Book edited successfully"], Response::HTTP_CREATED);
        }
        catch (\Throwable $th){
            return response()->json(["message" => $th->getMessage()], Response::HTTP_NOT_FOUND);
        }
    }

    public function getBookByIsbn($isbnBook)
    {
        $books = $this->book->where('isbn', $isbnBook)->paginate(15);
        return \response()->json(BookResource::collection($books)->response()->getData(true), Response::HTTP_CREATED);
    }

    public function restoreBook($bookId)
    {
        try{
            $this->book->withTrashed()->where('id', $bookId)->restore();
            return response()->json(["message"=> "Book restored successfully"], Response::HTTP_CREATED);
        }
        catch (\Throwable $th){
            return response()->json(["message" => $th->getMessage()], Response::HTTP_NOT_FOUND);
        }
    }
}
