<?php

namespace App\Controllers;

use App\Services\Auth;
use Core\View;

class AuthController
{
    public static function create(): string
    {
        return View::render('auth/create', layout: 'layouts/main');
    }
    public static function store(): string
    {
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;
        echo Auth::attempt($email, $password);
        die("posted");
        // return View::render('auth/store', layout: 'layouts/main');
    }
}
