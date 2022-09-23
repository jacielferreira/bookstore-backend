<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct(
        private BookService $bookService
    )
    {}

    public function index()
    {
        return $this->bookService->getBooks();
    }

    public function create(Request $request)
    {
        //
    }

    public function store(Request $request)
    {
        return $this->bookService->addBook($request->all());
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
