@extends("layout")
@section("content")
<div>
    <h1>{{$galleryBook->title}}</h1>
    <p>{{$galleryBook->description}}</p>
    @if (Auth::check() && Auth::user()->id == $galleryBook->author_id)
    <a href="{{ URL::route("album/item/new", array('gallerybook' => $galleryBook->id)) }}">
        Nieuwe foto
    </a>
    @endif
    <div class ='gallery-book'>
        <h2>Fotos</h2>
        @foreach($galleryBook->galleryItems as $galleryItem)
            <div class="gallery-item">
                <a href="{{ URL::route("_image", array('type' => $galleryItem->type, 'w' => 0, 'h'=> 0, 'name' => $galleryItem->id .'.'.$galleryItem->ext)) }}" data-lightbox="album-view", title="{{ $galleryItem->description }}">
                   <img src="{{ URL::route("_image", array('type' => $galleryItem->type, 'w' => 100, 'h'=> 0, 'name' => $galleryItem->id .'.'.$galleryItem->ext)) }}">
                   {{ $galleryItem->name }}
               </a>
            </div>
        @endforeach
    </div>
</div>
@stop
@section("css")
<link type="text/css"
              rel="stylesheet"
              href="/css/lightbox.css">
@stop
@section("javascript")
<script src="/js/lightbox-2.6.min.js"></script>
@stop