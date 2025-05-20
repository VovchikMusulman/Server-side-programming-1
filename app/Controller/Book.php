<?php

namespace Controller;

use Model\Book as BookModel;
use Src\Request;
use Src\View;
use Src\Validator\Validator;

class Book
{
    public function addBook(Request $request): string
    {
        if ($request->method === 'POST') {
            // Валидация данных
            $validator = new Validator($request->all(), [
                'title' => ['required'],
                'author' => ['required'],
                'year' => ['required', 'numeric'],
                'description' => ['required'],
            ], [
                'required' => 'Поле :field обязательно для заполнения',
                'numeric' => 'Поле :field должно быть числом'
            ]);

            if ($validator->fails()) {
                return new View('management.add-book', ['errors' => $validator->errors()]);
            }

            // Создание книги
            if (BookModel::create($request->all())) {
                app()->route->redirect('/');
            }
        }

        return new View('management.add-books');
    }
}