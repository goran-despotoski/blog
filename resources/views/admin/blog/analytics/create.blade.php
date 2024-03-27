<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Analytics') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <h1>{{__('Create Analytics script')}}</h1>
                <form action="{{route('admin.analytics.store')}}" method="POST">
                    @csrf
                    <div class="form-element">
                        <label for="title">
                            {{__('Title')}}
                        </label>
                        <input type="text" name="title" value="{{old('title')}}"
                               class="@error('title') is-invalid @enderror"/>
                        @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-element">
                        <label for="script_content">
                            {{__('Script Content (Paste your analytics content)')}}
                        </label>
                        <textarea type="text" name="script_content" rows="10"
                                  class="@error('script_content') is-invalid @enderror">{{old('script_content')}}</textarea>
                        @error('script_content')
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
