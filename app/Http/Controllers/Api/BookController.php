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
        //
    }

    public function create(Request $request)
    {
        return $this->bookService->addNewBook($request->all());
    }

    public function store(Request $request)
    {
        //
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
