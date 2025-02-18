<?php

namespace App\Controllers;

use Core\View;
use App\Models\User;

class HomeController
{
    public function index(): string
    {

        return View::render('Home/index', layout: 'layouts/main');
    }
}
