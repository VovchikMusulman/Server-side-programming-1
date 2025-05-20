<?php

use Src\Route;

// Публичные маршруты
Route::add('GET', '/', [Controller\Site::class, 'index']);
Route::add('GET', '/popular-books', [Controller\Site::class, 'popularbooks']);
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);

// Защищенные маршруты (требуют аутентификации)
Route::add('GET', '/logout', [Controller\Site::class, 'logout'])->middleware('auth');
Route::add(['GET', 'POST'], '/add-books', [Controller\Book::class, 'addBook'])
    ->middleware('auth');
//Route::add('GET', '/add-book', [Controller\Book::class, 'addbook'])->middleware('auth');
// ... другие маршруты управления