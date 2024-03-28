<?php

namespace Tests\Feature\Controllers;

use App\Models\Post;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testPostsPageShowsNoPosts()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Oh oh. No blog posts found.');
    }

    public function testPostsPageShowsPublishedPostsInPast()
    {
        $post = Post::factory([
            'title' => 'testing is for men',
        ])->statusPublished()->publishedAtInPast()->create();
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('testing is for men');
    }

    public function testPostPageShowsPublishedPost()
    {
        $post = Post::factory([
            'title' => 'testing is nice',
            'slug' => 'testing-is-nice',
        ])->statusPublished()->publishedAtInPast()->create();
        $response = $this->get('/posts/testing-is-nice');

        $response->assertStatus(200);
        $response->assertSee('testing is nice');
    }

    public function testPostPageShowsNotFoundOnNonExistingSlug()
    {
        $post = Post::factory([
            'title' => 'testing is nice',
            'slug' => 'testing-is-nice',
        ])->statusPublished()->publishedAtInPast()->create();

        $response = $this->get('/posts/testing-is-nice-but');

        $response->assertStatus(404);
    }
}
