<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <h1>{{__('Delete Blog Post')}}</h1>
                <form action="{{route('admin.posts.destroy', ['post' => $post->id])}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="alert alert-danger p-4">
                        {{__('Are you sure you want to delete the blog post titled')}} <u>"{{$post->title}}"</u>? <b>This action is irreversible!</b>
                    </div>
                    <div class="p-4">
                        <button type="submit">{{__('Delete')}}</button>
                        <a href="{{route('admin.posts.index')}}" class="ml-10">{{__('Go back to post list')}}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
