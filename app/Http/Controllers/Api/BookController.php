<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Interfaces\BookRepositoryInterface;
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

    public function index(): JsonResponse
    {
        return response()->json(['data' => $this->bookRepository->getBooks()]);
    }

    public function store(BookRequest $bookRequest): JsonResponse
    {
        return response()->json(['data' => $this->bookRepository->addBooks($bookRequest->all())],  ResponseAlias::HTTP_CREATED);
    }

    public function show($isbnBook)
    {
        return response()->json(['data' => $this->bookRepository->getBookByIsbn($isbnBook)]);
    }

    public function update(BookRequest $bookRequest, $bookId)
    {
        return response()->json(['data' => $this->bookRepository->updateBook($bookId, $bookRequest->all())]);
    }

    public function destroy($bookId)
    {
        return response()->json(['data' => $this->bookRepository->deleteBook($bookId)]);
    }
}
