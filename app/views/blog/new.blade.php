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
        {{ Form::text("title", $blog->title, array(
            "placeholder" => "Titel"
        )) }}
        
        {{ Form::label("boyd", "Text") }}
        {{ Form::textarea("body", $blog->body, array(
            "placeholder" => "Bericht",
            "class"       => 'redactor'
        )) }}
        {{ Form::submit("Opslaan") }}
    {{ Form::close() }}
@stop
@section("javascript")
<script type="text/javascript">
    $(function() {
          $('.redactor').redactor({
                imageUpload: "{{ URL::route('blog/uploadfile') }}",
                minHeight: 200,
                lang: 'nl'
          });
    });
</script>
@stop