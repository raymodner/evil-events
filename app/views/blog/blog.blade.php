@extends("layout")
@section("content")
<div>
    <div class="post">
    <h1>{{ $blog->title }}</h1>
    @if ( Auth::user() && Auth::user()->id == $blog->author_id )
    {{ HTML::link('blog/edit/'.$blog->id, 'bewerk') }}
    @endif
    <p>{{ $blog->body }}</p>
    </div
</div>
@stop