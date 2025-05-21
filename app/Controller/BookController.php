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
}

