@extends("layout")
@section("content")
<div class='error'>
@foreach($errors->all() as $error)
    {{ $error }}
@endforeach
</div>
    {{ Form::open(array(
        "action"    => $action,
    )) }}
        {{ Form::label("title", "Title") }}
        {{ Form::text("title", $album->title, array(
            "placeholder" => "Titel"
        )) }}
        
        {{ Form::label("description", "Beschrijving") }}
        {{ Form::textarea("description", $album->description, array(
            "placeholder" => "Beschrijving"
        )) }}
        {{ Form::submit("Opslaan") }}
    {{ Form::close() }}
@stop