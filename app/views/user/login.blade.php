@extends("layout")
@section("content")
<div class="left-area2">
	<section class="left-inner2 box clearfix ">
		<div class='error'>
		@foreach($errors->all() as $error)
			{{ $error }}
		@endforeach
		</div>
<!--		<div class="form">-->
<!--			{{ Form::open(array(-->
<!--				"route"        => "user/login",-->
<!--				"autocomplete" => "off"-->
<!--			)) }}-->
<!--				{{ Form::label("username", "Username") }}-->
<!--				{{ Form::text("username", Input::old("username"), array(-->
<!--					"placeholder" => "Username"-->
<!--				)) }}-->
<!--				{{ Form::label("password", "Password") }}-->
<!--				{{ Form::password("password", array(-->
<!--					"placeholder" => "●●●●●●●●●●"-->
<!--				)) }}-->
<!--				{{ Form::submit("login") }}-->
<!--			{{ Form::close() }}-->
<!--		</div>-->
		<div>
			<a href="{{ URL::route('user/request')}}">Forgot password?</a>
		</div>
	</section>

</div>
<div class="left-area1">
	<section class="left-inner1 box">

		asasds
	</section>
</div>
<div class="left-area1">
	<section class="left-inner1 box">

		asdsd
	</section>
</div>
@stop
@section("footer")
    @parent
@stop