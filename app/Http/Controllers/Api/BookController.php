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

    public function create(Request $request)
    {
        //
    }

    public function store(Request $request): JsonResponse
    {
        $book = $request->all();
        return response()->json(['data' => $this->bookRepository->addBooks($book)]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
