<?php

use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BookController;


Route::apiResource('authors', AuthorController::class);
Route::apiResource('books', BookController::class);