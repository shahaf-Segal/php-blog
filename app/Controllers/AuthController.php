<?php

namespace App\Controllers;

use Core\View;

class AuthController
{
    public static function create(): string
    {
        return View::render('auth/create', layout: 'layouts/main');
    }
    public static function store(): string
    {
        return View::render('auth/store', layout: 'layouts/main');
    }
}
