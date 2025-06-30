<?php

namespace App\Controllers;

use App\Services\Auth;
use Core\Router;
use Core\View;

class AuthController
{
    public static function create(): string
    {
        return View::render('auth/create', layout: 'layouts/main');
    }
    public static function store(): void
    {
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;
        $remember = $_POST['remember'] ?? false;
        if (Auth::attempt($email, $password)) {
            Router::redirect('/');
        } else {
            Router::redirect('/login');
        }
    }
    public static function destroy(): void
    {
        Auth::logout();
        Router::redirect('/');
    }
}
