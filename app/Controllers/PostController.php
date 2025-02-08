<?php

namespace App\Controllers;

class PostController
{
    public function index(): string
    {
        return 'Posts!';
    }
    public function show(int $id): string
    {
        return "Post $id";
    }
}
