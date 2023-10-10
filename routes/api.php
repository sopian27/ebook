<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


//Route::post('/book_access', [BookController::class,'book_access'])->middleware(['auth:sanctum']);
Route::get('/list_book', [BookController::class,'index']);
Route::post('/book/detail', [BookController::class,'book_detail']);
Route::get('/book_access', [BookController::class,'book_access']);

Route::get('image/{path}', [ImageController::class, 'getImage'])->where('path', '.*');
Route::post('image', [ImageController::class, 'uploadImage']);
