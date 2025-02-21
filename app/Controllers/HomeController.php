<?php

namespace App\Controllers;

use Core\View;
use App\Models\Post;

class HomeController
{
    public function index(): string
    {
        $posts = Post::getRecent(5);
        return View::render(
            template: 'Home/index',
            data: [
                'posts' => $posts
            ],
            layout: 'layouts/main'
        );
    }
}
