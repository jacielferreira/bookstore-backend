<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Interfaces\BookRepositoryInterface;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class BookController extends Controller
{

    public function __construct(
       private BookRepositoryInterface $bookRepository
    )
    {}

    public function index(Request $request): JsonResponse
    {
        return $this->bookRepository->getBooks($request->all());
    }

    public function store(BookRequest $bookRequest): JsonResponse
    {
        return $this->bookRepository->addBooks($bookRequest->all());
    }

    public function show($isbnBook)
    {
        return $this->bookRepository->getBookByIsbn($isbnBook);
    }

    public function update(BookRequest $bookRequest, $bookId)
    {
        return $this->bookRepository->updateBook($bookId, $bookRequest->all());
    }

    public function restoreBook($bookId)
    {
        return $this->bookRepository->restoreBook($bookId);
    }

    public function forceDelete($bookId)
    {
        return $this->bookRepository->forceDelete($bookId);
    }

    public function destroy($bookId)
    {
        return $this->bookRepository->deleteBook($bookId);
    }
}
