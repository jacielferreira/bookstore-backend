<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    BookController,
    AuthController
};

Route::post('/auth/register', [AuthController::class, 'registerUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);
Route::post('/auth/logout', [AuthController::class, 'logoutUser']);

Route::middleware('sanctum')->prefix('books')->group(function(){
    Route::get('/', [BookController::class, 'index'])->name('books.index');
    Route::post('/', [BookController::class, 'store'])->name('books.store');
    Route::get('/{book}', [BookController::class, 'show'])->name('books.show');
    Route::put('/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/delete/{book}', [BookController::class, 'destroy'])->name('books.delete');
    Route::delete('/force-delete/{book}', [BookController::class, 'forceDelete'])->name('books.force-delete');
    Route::post('/restore/{book}', [BookController::class, 'restoreBook'])->name('books.restore');
});
