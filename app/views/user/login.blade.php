@extends("layout")
@section("content")
<div class='error'>
@foreach($errors->all() as $error)
    {{ $error }}
@endforeach
</div>
<div>
    {{ Form::open(array(
        "route"        => "user/login",
        "autocomplete" => "off"
    )) }}
        {{ Form::label("username", "Username") }}
        {{ Form::text("username", Input::old("username"), array(
            "placeholder" => "Username"
        )) }}
        {{ Form::label("password", "Password") }}
        {{ Form::password("password", array(
            "placeholder" => "●●●●●●●●●●"
        )) }}
        {{ Form::submit("login") }}
    {{ Form::close() }}
</div>
<div>
    <a href="{{ URL::route('user/request')}}">Forgot password?</a>
</div>
@stop
@section("footer")
    @parent
    <script src="//polyfill.io"></script>
@stop