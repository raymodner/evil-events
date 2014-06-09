@extends("layout")
@section("content")
<div>
    @if (Auth::check() && Auth::user()->id == $user->id)
    <a href="{{ URL::route("album/new", array('user' => $user->id)) }}">
        Nieuw album
    </a>
    @endif
    <table class="media">
        <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Description</th>
        <th>Action</th>
        </tr>
        @foreach($galleryBooks as $galleryBook)
            <tr>
                @if( $galleryBook->galleryItems()->count() > 0)
                <td><img src="{{ URL::route("_image", array('type' => $galleryBook->galleryItems()->first()->type, 'w' => 100, 'h' => 0, 'name' => $galleryBook->galleryItems()->first()->id.'.'.$galleryBook->galleryItems()->first()->ext)) }}"></td>
                @else
                    <td><img src="http://placehold.it/100X50&text=No+preview+available"></td>
                @endif
                <td>{{ HTML::link('media/album/'.$galleryBook->id, $galleryBook->title) }}</td>
                <td>
                    @if(strlen($galleryBook->description) > 120)
                    {{ substr(strip_tags($galleryBook->description),0, 120).' [..]' }}
                    @else
                        {{$galleryBook->description}}
                    @endif
                </td>
                <td>{{ HTML::link('media/album/'.$galleryBook->id, 'show') }}</td>
            </tr>
    @endforeach
    </table>
</div>
@stop