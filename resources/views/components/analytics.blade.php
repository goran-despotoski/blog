<!-- Analytics Scripts -->
@foreach($analytics as $analytic)
    <!-- {{ $analytic->title }} -->
    {!! $analytic->script_content !!}
@endforeach
