<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    BookController
};

Route::get('/', function (){
    return response()->json(["message"=>"Book Backend running."]);
});

Route::apiResource('books', BookController::class);

