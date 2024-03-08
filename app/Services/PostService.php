<?php

namespace App\Services;

use App\DataTransferObjects\PostDTO;
use App\Models\Post;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class PostService
{
    public function getPublishedPosts(): LengthAwarePaginator
    {
        return Post::published()
            ->orderBy('published_at', 'desc')->paginate();
    }

    public function getPublishedPostBySlug(string $postSlug): ?Post
    {
        return Post::published()->where('slug', $postSlug)->first();
    }

    public function getByUser(User $user): LengthAwarePaginator
    {
        return Post::query()->where('user_id', $user->id)->paginate();
    }

    public function store(User $user, PostDTO $postDTO): Post
    {
        $post = new Post();
        $post->user_id = $user->id;
        $post->title = $postDTO->title;
        $post->slug = $postDTO->slug;
        $post->content = $postDTO->content;
        $post->published_at = $postDTO->published_at_date.' '.$postDTO->published_at_time;
        $post->status = $postDTO->status;
        $post->save();

        return $post;
    }

    public function update(User $user, Post $post, PostDTO $postDTO): Post
    {
        $post->user_id = $user->id;
        $post->title = $postDTO->title;
        $post->slug = $postDTO->slug;
        $post->content = $postDTO->content;
        $post->published_at = $postDTO->published_at_date.' '.$postDTO->published_at_time;
        $post->status = $postDTO->status;
        $post->save();

        return $post->refresh();
    }

    public function destroy(User $user, Post $post): bool
    {
        return Post::destroy($post->id);
    }
}
