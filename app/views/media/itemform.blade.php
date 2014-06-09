@extends("layout")
@section("content")
<div class='error'>
@foreach($errors->all() as $error)
    {{ $error }}
@endforeach
</div>
    {{ Form::open(array(
        "action"    => $action,
        'file' => true, 
        'enctype' => 'multipart/form-data'
    )) }}
        {{ Form::label("name", "Name") }}
        {{ Form::text("name", $galleryItem->name, array(
            "placeholder" => "Naam"
        )) }}
        
        {{ Form::label("description", "Beschrijving") }}
        {{ Form::textarea("description", $galleryItem->description, array(
            "placeholder" => "Beschrijving"
        )) }}
        
        {{ Form::label("file", "Bestand") }}
        {{ Form::file("file") }}
        {{ Form::submit("Opslaan") }}
    {{ Form::close() }}
@stop