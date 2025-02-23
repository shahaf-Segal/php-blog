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
        $search = $_GET['search'] ?? '';
        $page =  $_GET['page'] ?? 1;
        $pageLimit = 2;

        // $totalPosts = Post::count();
        $posts = Post::getRecent(limit: $pageLimit, search: $search, page: $page);
        $totalPosts = Post::count($search);

        return View::render(
            template: 'post/index',
            data: [
                'posts' => $posts,
                'search' => $search,
                'currentPage' => $page,
                'totalPages' => ceil($totalPosts / $pageLimit)
            ],
            layout: 'layouts/main'
        );
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
