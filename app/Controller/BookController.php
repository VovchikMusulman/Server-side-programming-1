<?php

namespace Controller;

use Model\Book;
use Model\Book as BookModel;
use Src\Request;
use Src\View;

class BookController
{
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

    public function acceptBook(Request $request): string
    {
        // Получаем книги, которые сейчас выданы читателям
        $issuedBooks = Book::with('reader')
            ->whereNotNull('reader_id')
            ->orderBy('issue_date', 'desc')
            ->get();

        // Обработка возврата книги
        if ($request->method === 'POST') {
            $bookId = $request->get('book_id');

            $book = Book::find($bookId);
            if ($book && $book->reader_id) {
                // Обнуляем данные о выдаче
                $book->reader_id = null;
                $book->issue_date = null;
                $book->save();

                // Перенаправляем с сообщением об успехе
                app()->route->redirect('/accept-book?success=1');
            }
        }

        return (new View())->render('management.accept-book', [
            'books' => $issuedBooks,
            'success' => $request->get('success')
        ]);
    }
}

