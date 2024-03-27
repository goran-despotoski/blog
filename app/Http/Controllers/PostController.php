<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use App\Services\TeamService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(
        private PostService $postService,
        private TeamService $teamService
    ) {
    }

    public function index(Request $request)
    {
        $posts = $this->postService->getPublishedPosts();
        $team = $this->teamService->getTeamById($request->header('current-team-id') ?? config('app.current_team_id'));

        return view('posts.index', ['posts' => $posts, 'team' => $team]);
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
