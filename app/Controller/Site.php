<?php

namespace Controller;

use Model\Book;

// Изменяем Post на Book
use Src\View;
use Src\Request;
use Model\User;
use Src\Auth\Auth;

class Site
{
    public function index(Request $request): string
    {
        $id = $request->get('id');

        if ($id) {
            $books = Book::where('id', $id)->get();
        } else {
            $books = Book::all(); // Получаем все книги вместо постов
        }

        return (new View())->render('site.main', ['books' => $books]); // Меняем posts на books
    }

    public function signup(Request $request): string
    {
        if ($request->method === 'POST' && User::create($request->all())) {
            app()->route->redirect('/go');
        }
        return new View('site.signup');
    }

    public function login(Request $request): string
    {
        if ($request->method === 'GET') {
            return new View('site.login');
        }
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/');
        }
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/');
    }

    public function popularbooks(): string
    {
        $popularBooks = Book::orderBy('views', 'desc')->take(5)->get(); // Пример для популярных книг
        return new View('site.popular-books', ['books' => $popularBooks]);
    }
}