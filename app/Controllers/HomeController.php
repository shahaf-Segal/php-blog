<?php

namespace App\Controllers;

use Core\View;

class HomeController
{
    public function index(): string
    {
        return View::render('Home/index', layout: 'layouts/main');
    }
}
