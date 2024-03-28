<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Analytics') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <a href="{{route('admin.analytics.create')}}">{{__('Create new analytics post')}}</a><br/>
                <table>
                    <tr>
                        <th>{{__('ID')}}</th>
                        <th>{{__('Title')}}</th>
                        <th></th>
                    </tr>
                    @if($analytics->count() > 0)
                        @foreach($analytics as $analytic)
                            <tr>
                                <td>{{$analytic->id}}</td>
                                <td>{{$analytic->title}}</td>
                                <td>
                                    <a href="{{route('admin.analytics.edit', ['analytic' => $analytic->id])}}">{{__('Edit')}}</a>
                                    | <a
                                        href="{{route('admin.analytics.delete', ['analytic' => $analytic->id])}}">{{__('Delete')}}</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">{{__("No analytics were found, try to create one and you'll see them here")}}</td>
                        </tr>
                    @endif
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
