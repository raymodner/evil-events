@extends("layout")
@section("content")
<div class="left-area3">
	<section class="left-inner3 box clearfix ">
		<h3>Evil Events</h3>
		<ul>
			<li>Telefoon: +31 6 553 964 33</li>
			<li>Email: info@evil-events.nl</li>
			<li><a class="fancybox fancybox.ajax" href="{{ URL::to('contact/add') }}">Contactformulier</a></li>
		</ul>
	</section>

</div>
@stop
@section("footer")
@parent
@stop