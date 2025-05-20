<?php

namespace Controller;

use Model\Post;
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
            $posts = Post::where('id', $id)->get();
        } else {
            $posts = Post::all(); // или вернуть все посты, если id не указан
        }

        return (new View())->render('site.main', ['posts' => $posts]);
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
        //Если просто обращение к странице, то отобразить форму
        if ($request->method === 'GET') {
            return new View('site.login');
        }
        //Если удалось аутентифицировать пользователя, то редирект
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/');
        }
        //Если аутентификация не удалась, то сообщение об ошибке
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/');
    }

    public function popularbooks(): string
    {
        return new View('site.popular-books');
    }
}