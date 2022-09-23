<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\BookRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

    public function store(Request $request): JsonResponse
    {
        return response()->json(['data' => $this->bookRepository->addBooks($request->all())]);
    }

    public function show($isbnBook)
    {
        return response()->json(['data' => $this->bookRepository->getBookByIsbn($isbnBook)]);
    }

    public function update(Request $request, $bookId)
    {
        return response()->json(['data' => $this->bookRepository->updateBook($bookId, $request->all())]);
    }

    public function destroy($bookId)
    {
        return response()->json(['data' => $this->bookRepository->deleteBook($bookId)]);
    }
}
