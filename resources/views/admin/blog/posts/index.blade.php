<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <a href="{{route('admin.posts.create')}}">{{__('Create new blog post')}}</a><br/>
                <table>
                    <tr>
                        <th>{{__('ID')}}</th>
                        <th>{{__('Title')}}</th>
                        <th>{{__('Published At')}}</th>
                        <th>{{__('Status')}}</th>
                        <th></th>
                    </tr>
                    @if($posts->count() > 0)
                    @foreach($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->published_at}}</td>
                        <td>{{$post->status}}</td>
                        <td>
                            <a href="{{route('admin.posts.edit', ['post' => $post->id])}}">{{__('Edit')}}</a> | <a href="{{route('posts.show', ['postSlug' => $post->slug])}}" target="_blank">{{__('Preview')}}</a> | <a href="{{route('admin.posts.delete', ['post' => $post->id])}}">{{__('Delete')}}</a>
                        </td>
                    </tr>
                    @endforeach
                    @else
                        <tr>
                            <td colspan="5">{{__("No blog posts were found, try to create one and you'll see them here")}}</td>
                        </tr>
                    @endif
                </table>
                {{$posts->links()}}

            </div>
        </div>
    </div>
</x-app-layout>
