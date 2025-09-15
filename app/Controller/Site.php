<?php

namespace Controller;

use Model\Book;
use Src\View;
use Src\Request;
use Model\User;
use Src\Auth\Auth;
use Src\Validator\Validator;

class Site
{
    public function index(Request $request): string
    {
        $id = $request->get('id');

        if ($id) {
            $books = Book::where('id', $id)->get();
        } else {
            $books = Book::all();
        }

        return (new View())->render('site.main', ['books' => $books]);
    }

    public function signup(Request $request): string
    {
        if ($request->method === 'POST') {

            $validator = new Validator($request->all(), [
                'name' => ['required'],
                'login' => ['required', 'unique:users,login'],
                'password' => ['required']
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально'
            ]);

            if($validator->fails()){
                return new View('site.signup',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            if (User::create($request->all())) {
                app()->route->redirect('/login');
            }
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
        $popularBooks = Book::orderBy('views', 'desc')->take(5)->get();
        return new View('site.popular-books', ['books' => $popularBooks]);
    }

    public function addLibrarian(Request $request): string
    {
        if ($request->method === 'POST') {
            $userData = $request->all();
            $userData['role'] = 'librarian';

            if (User::create($userData)) {
                app()->route->redirect('/add-librarians?success=1');
            }
        }

        return (new View())->render('management.add-librarians', [
            'success' => $request->get('success')
        ]);
    }

    public function addReader(Request $request): string
    {
        if ($request->method === 'POST') {
            $userData = $request->all();
            $userData['role'] = 'reader';

            if (User::create($userData)) {
                app()->route->redirect('/add-reader?success=1');
            }
        }

        return (new View())->render('management.add-reader', [
            'success' => $request->get('success')
        ]);
    }
}