<x-public-layout>
    <div class="">
        <h1>{{__('Post')}}</h1>
        <div class="back-to-posts">
            <a href="{{route('posts')}}">{{__('Back to posts')}}</a>
        </div>

        <div class="blog-sinopsis">{{__('Blog dedicated to IT, Coding, Devops and all things techy.')}}</div>
        <div class="post-list-item">

            <h2>{{$post->title}}</h2>
            <div>
                {{__('Written by')}} <b>{{$post->user->name}}</b>
                <div class="date-holder">
                    <time datetime="{{$post->published_at}}">{{$post->published_at_date_readable}}</time>
                </div>
            </div>
            <div class="content">
                {!! $post->content !!}
            </div>
        </div>
    </div>

</x-public-layout>
<?php
