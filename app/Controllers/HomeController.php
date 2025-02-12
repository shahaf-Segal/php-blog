<?php

namespace App\Controllers;

use Core\View;
use App\Models\User;

class HomeController
{
    public function index(): string
    {
        $user = User::create([
            'name' => 'John Doe',
            'email' => '0kXnI@example.com',
            'password' => 'password',
            'salt' => 'salt'
        ]);

        return View::render('Home/index', layout: 'layouts/main');
    }
}
