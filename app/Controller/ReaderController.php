<?php

namespace Controller;

use Model\Book;
use Model\Reader;
use Src\Request;
use Src\View;

class ReaderController
{
    public function giveBook(Request $request): string
    {
        // Получаем списки книг и читателей
        $books = Book::all();
        $readers = Reader::all();

        // Обработка формы выдачи
        if ($request->method === 'POST') {
            // Простая обработка без валидации
            $bookId = $request->get('book_id');
            $readerId = $request->get('reader_id');
            $issueDate = date('Y-m-d H:i:s'); // Текущая дата

            // Здесь должна быть логика сохранения выдачи книги
            // Например, обновление записи в таблице books:
            $book = Book::find($bookId);
            if ($book) {
                $book->reader_id = $readerId;
                $book->issue_date = $issueDate;
                $book->save();
            }

            // Перенаправление после успешной выдачи
            app()->route->redirect('/give-books?success=1');
        }

        return new View('management.give-books', [
            'books' => $books,
            'readers' => $readers,
            'success' => $request->get('success')
        ]);
    }

    public function addReader(Request $request): string
    {
        if ($request->method === 'POST') {
            $reader = Reader::create([
                'name' => $request->get('name'),
                'surname' => $request->get('surname'),
                'patronymic' => $request->get('patronymic'),
                'phone' => $request->get('phone'),
                'address' => $request->get('address'),
                'email' => $request->get('email'),
                'birth_date' => $request->get('birth_date')
            ]);

            if ($reader) {
                app()->route->redirect('/');
            }
        }

        return new View('management.add-reader');
    }

    public function readersBooks(Request $request): string
    {
        try {
            $books = Book::with('reader')
                ->whereNotNull('reader_id')
                ->orderBy('issue_date', 'desc')
                ->get();

            return (new View())->render('management.books-readers', [
                'books' => $books
            ]);

        } catch (\Exception $e) {
            // Логирование ошибки
            error_log('Error in readersBooks: ' . $e->getMessage());
            return (new View())->render('errors.500', [], 500);
        }
    }
}