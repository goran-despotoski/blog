<x-public-layout>
    <div class="">

        <h1>{{ $team->owner->name }}</h1>
        <div class="blog-sinopsis">{{__('Blog dedicated to Software Development, Coding, DevOps and all things techy.')}}</div>

        @if ($posts->count() == 0)
            <div class="text-center text-red-600">{{__('Oh oh. No blog posts found.')}}</div>
        @else
        @foreach($posts as $post)
            <div class="post-list-item">
                <div class="date-holder"><time datetime="{{$post->published_at}}">{{$post->published_at_date_readable}}</time></div>
                <h2>{{$post->title}}</h2>
                <div class="content">
                    {{ \Str::limit($post->content_simple_text, '150', '...')}}
                </div>
                <div class="read-mode-holder">
                    <a href="{{route('posts.show', ['postSlug' => $post->slug])}}">{{__('Read more')}}</a>
                </div>
            </div>
        @endforeach
        {{$posts->links()}}
        @endif
    </div>

</x-public-layout>
