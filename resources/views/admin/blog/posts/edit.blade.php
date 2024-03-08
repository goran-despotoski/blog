<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <h1>{{__('Edit Blog Post')}}</h1>
                <form action="{{route('admin.posts.update',$post->id)}}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-element">
                        <label for="title">
                            {{__('Title')}}
                        </label>
                        <input type="text" name="title" value="{{old('title', $post->title)}}"
                               class="@error('title') is-invalid @enderror"/>
                        @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-element">
                        <label for="content">
                            {{__('Content')}}
                        </label>
                        <textarea type="text" name="content"
                                  class="@error('content') is-invalid @enderror">{{old('content',$post->content)}}</textarea>
                        @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-element">
                        <label for="published_at">
                            {{__('Published at')}}
                        </label>
                        <div class="grid grid-cols-2 gap-1">
                            <div>
                                <input type="date" name="published_at_date" value="{{old('published_at_date', $post->published_at_date)}}"
                                       class="@error('published_at_date') is-invalid @enderror"/>
                                @error('published_at_date')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <input type="time" name="published_at_time" value="{{old('published_at_time', $post->published_at_time)}}"
                                       class="@error('published_at_time') is-invalid @enderror"/>
                                @error('published_at_time')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                    </div>
                    <div class="form-element">
                        <label for="status">
                            {{__('Status')}}
                        </label>
                        <select name="status">
                            <option name="">{{__('Please select')}}</option>
                            @foreach($statuses as $status)
                                <option
                                    value="{{$status->value}}" {{(old('status', $post->status) == $status->value)?'selected="selected"':''}}>{{__($status->value)}}</option>
                            @endforeach
                        </select>
                        @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <button type="submit">{{__('Save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
