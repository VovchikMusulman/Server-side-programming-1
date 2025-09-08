<?php

use Src\Route;

// Публичные маршруты
Route::add('GET', '/', [Controller\Site::class, 'index']);
Route::add('GET', '/popular-books', [Controller\BookController::class, 'popularbooks']);
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);

// Защищенные маршруты (требуют аутентификации)
Route::add('GET', '/logout', [Controller\Site::class, 'logout'])->middleware('auth');

// Защищенные маршруты (требуют прав администратора)
Route::add(['GET', 'POST'], '/add-books', [Controller\BookController::class, 'addBook'])->middleware('auth');
Route::add(['GET', 'POST'], '/add-reader', [Controller\Site::class, 'addReader'])->middleware('auth');
Route::add(['GET', 'POST'], '/give-books', [Controller\BookController::class, 'giveBook'])->middleware('auth');
Route::add(['GET', 'POST'], '/readers-books', [Controller\BookController::class, 'readersBooks'])->middleware('auth');
Route::add(['GET', 'POST'], '/add-librarians', [Controller\Site::class, 'addLibrarian'])->middleware('auth');