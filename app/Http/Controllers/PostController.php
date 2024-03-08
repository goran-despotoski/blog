<?php

namespace App\Http\Controllers;

use App\Services\PostService;

class PostController extends Controller
{
    public function __construct(
        private PostService $postService
    ) {
    }

    public function index()
    {
        $posts = $this->postService->getPublishedPosts();

        return view('posts.index', ['posts' => $posts]);
    }

    public function show(string $postSlug)
    {
        $post = $this->postService->getPublishedPostBySlug($postSlug);
        if (! $post) {
            abort(404);
        }

        return view('posts.show', ['post' => $post]);
    }
}
