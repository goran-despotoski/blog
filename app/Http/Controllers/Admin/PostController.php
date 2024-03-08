<?php

namespace App\Http\Controllers\Admin;

use App\DataTransferObjects\PostDTO;
use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\DestroyPostRequest;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function __construct(
        private PostService $postService
    ) {

    }

    public function index(Request $request)
    {
        $posts = $this->postService->getByUser(auth()->user());

        return view('admin.blog.posts.index', ['posts' => $posts]);
    }

    public function create()
    {
        return view('admin.blog.posts.create', ['statuses' => StatusEnum::cases()]);
    }

    public function store(StorePostRequest $request)
    {
        $postDto = PostDTO::fromArray(array_merge($request->all()));
        $postDto->slug = Str::slug($postDto->title);

        $this->postService->store(auth()->user(), $postDto);

        return redirect()->route('admin.posts.index', ['status' => 'created_success']);
    }

    public function edit(Post $post)
    {
        $postDto = PostDTO::fromArray($post->toArray());

        return view('admin.blog.posts.edit', ['post' => $postDto, 'statuses' => StatusEnum::cases()]);
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $postDto = PostDTO::fromArray($request->all());
        $postDto->slug = Str::slug($postDto->title);

        $this->postService->update(auth()->user(), $post, $postDto);

        return redirect()->route('admin.posts.index', ['status' => 'updated_success']);
    }

    public function delete(Post $post)
    {
        $postDto = PostDTO::fromArray($post->toArray());

        return view('admin.blog.posts.delete', ['post' => $postDto, 'statuses' => StatusEnum::cases()]);
    }

    public function destroy(DestroyPostRequest $request, Post $post)
    {
        $this->postService->destroy(auth()->user(), $post);

        return redirect()->route('admin.posts.index', ['status' => 'deleted_success']);
    }
}
