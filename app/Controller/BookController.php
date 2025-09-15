<?php

namespace Controller;

use Model\Book;
use Model\Book as BookModel;
use Src\Request;
use Src\View;
use Src\Validator\Validator; // <-- добавьте эту строку

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
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'title' => ['required'],
                'author' => ['required'],
                'year' => ['required', 'numeric', 'min:1000', 'max:' . date('Y')],
                'price' => ['required', 'numeric', 'min:0'],
                'description' => ['max:1000'],
                'image' => ['file_extension:jpeg,png,jpg,gif', 'file_size:2048'] // Валидация файла
            ], [
                'required' => 'Поле :field обязательно для заполнения',
                'numeric' => 'Поле :field должно быть числом',
                'min' => 'Поле :field должно быть не меньше :min',
                'max' => 'Поле :field должно быть не больше :max',
                'file_extension' => 'Файл :field должен быть одного из следующих типов: :file_extension',
                'file_size' => 'Размер файла :field не должен превышать :file_size КБ'
            ]);

            if ($validator->fails()) {
                return (new View('management.add-books'))->render(['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            $bookData = $request->all();
            $bookData['is_new'] = isset($bookData['is_new']) ? 1 : 0;
            $bookData['popular_book'] = isset($bookData['popular_book']) ? 1 : 0;
            $bookData['image'] = null; // По умолчанию null

            // Обработка загрузки изображения
            if ($request->files()['image']['tmp_name']) {
                $uploadDir = 'uploads/images/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $fileExtension = pathinfo($request->files()['image']['name'], PATHINFO_EXTENSION);
                $fileName = uniqid() . '.' . $fileExtension;
                $filePath = $uploadDir . $fileName;
                if (move_uploaded_file($request->files()['image']['tmp_name'], $filePath)) {
                    $bookData['image'] = '/uploads/images/' . $fileName;
                }
            }

            if (BookModel::create($bookData)) {
                app()->route->redirect('/');
            }
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