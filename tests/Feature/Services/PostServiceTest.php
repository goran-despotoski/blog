<?php

namespace Tests\Feature\Services;

use App\Models\Post;
use App\Services\PostService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testGetPublishedPostsReturnNoPostsWhenDbEmpty(): void
    {
        $service = new PostService();

        $posts = $service->getPublishedPosts();
        $this->assertEquals(0, $posts->count());
    }

    public function testGetPublishedPostsReturnNoPostsWhenWeHaveDraftOrArchivedOnly(): void
    {
        $service = new PostService();

        $draftPost = Post::factory()->create();
        $archivedPost = Post::factory()->statusArchived()->create();

        $posts = $service->getPublishedPosts();
        $this->assertEquals(0, $posts->count());
    }

    public function testGetPublishedPostsReturnNoPostsWhenStatusPublishedButPublishedDateInFuture(): void
    {
        $service = new PostService();

        $post = Post::factory()->statusPublished()->publishedAtInFuture()->create();

        $posts = $service->getPublishedPosts();
        $this->assertEquals(0, $posts->count());
    }

    public function testGetPublishedPostsReturnPostsWhenStatusPublishedButPublishedDateInPast(): void
    {
        $service = new PostService();

        $post = Post::factory()->statusPublished()->publishedAtInPast()->create();
        $anotherPost = Post::factory()->statusPublished()->publishedAtInPast()->create();
        $randomDraftPost = Post::factory()->create();

        $posts = $service->getPublishedPosts();
        $this->assertEquals(2, $posts->count());
    }
}
