<?php

namespace App\Controllers;

use App\Models\Post;

class PostController
{
    public function index(): string
    {
        return 'Posts!';
    }
    public function show(array $params): string
    {
        $id = $params['id'];
        $post = Post::find($id);

        return "$post->title - $id";
    }
}
