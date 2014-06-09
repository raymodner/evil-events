@extends("layout")
@section("content")
<div>
    @if (Auth::check())
    <a href="{{ URL::route("blog/new") }}">
        Nieuwe blog
    </a>
    @endif
    @foreach($posts as $post)
    <div class="post">
    <h2>{{ HTML::link('blog/show/'.$post->id, $post->title) }}</h2>
        <p>{{ substr(strip_tags($post->body),0, 120).' [..]' }}</p>
        <p>{{ HTML::link('blog/show/'.$post->id, 'Read more &rarr;') }}</p>
    </div>
    @endforeach
</div>
@stop