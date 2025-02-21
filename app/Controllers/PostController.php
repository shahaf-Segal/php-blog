<?php

namespace App\Controllers;

use App\Models\Post;
use Core\Router;

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

        if (!$post) {
            Router::notFound();
        }

        return "$post->title - $id";
    }
}
