<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Core\View;
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
        $comments = Comment::getForPost($id);

        $post->incrementViews($id);

        return View::render(
            template: 'Post/show',
            data: [
                'post' => $post,
                'comments' => $comments
            ],
            layout: 'layouts/main'
        );
    }
}
