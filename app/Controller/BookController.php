<?php

namespace Controller;

use Model\Book;
use Model\Book as BookModel;
use Src\Request;
use Src\View;

class BookController
{
    public function giveBook(Request $request): string
    {
        // Получаем всех читателей (пользователей с ролью 'reader')
        $readers = \Model\User::where('role', 'reader')->get();

        // Получаем доступные книги (те, которые не выданы)
        $availableBooks = Book::whereNull('reader_id')->get();

        // Обработка выдачи книги
        if ($request->method === 'POST') {
            $bookId = $request->get('book_id');
            $readerId = $request->get('reader_id');

            $book = Book::find($bookId);
            if ($book && !$book->reader_id) {
                // Устанавливаем данные о выдаче
                $book->reader_id = $readerId;
                // created_at будет автоматически установлен текущей датой
                $book->save();

                // Перенаправляем с сообщением об успехе
                app()->route->redirect('/give-books?success=1');
            }
        }

        return (new View())->render('management.give-books', [
            'readers' => $readers,
            'availableBooks' => $availableBooks,
            'success' => $request->get('success')
        ]);
    }
    public function readersBooks(Request $request): string
    {
        // Получаем книги, которые сейчас выданы читателям
        $issuedBooks = Book::with('reader')
            ->whereNotNull('reader_id')
            ->orderBy('created_at', 'desc')
            ->get();

        // Обработка возврата книги
        if ($request->method === 'POST') {
            $bookId = $request->get('book_id');

            $book = Book::find($bookId);
            if ($book && $book->reader_id) {
                // Обнуляем данные о выдаче
                $book->reader_id = null;
                $book->save();

                // Перенаправляем с сообщением об успехе
                app()->route->redirect('/readers-books');
            }
        }

        return (new View())->render('management.books-readers', [
            'books' => $issuedBooks,
            'success' => $request->get('success')
        ]);
    }
    public function addBook(Request $request): string
    {
        if ($request->method === 'POST' && BookModel::create($request->all())) {
            app()->route->redirect('/');
        }

        return new View('management.add-books');
    }

    public function popularbooks(Request $request): string
    {
        $id = $request->get('id');

        if ($id) {
            $books = Book::where('id', $id)->get();
        } else {
            $books = Book::all();
        }

        return (new View())->render('site.popular-books', ['books' => $books]);
    }
}