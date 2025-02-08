<?php

namespace App\Controllers;

class PostController
{
    public function index(): string
    {
        return 'Posts!';
    }
    public function show(array $params): string
    {
        $id = $params['id'];
        return "Post $id";
    }
}
