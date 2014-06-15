@extends("layout")
@section("content")
<div class="left-area3">
	<section class="left-inner3 box clearfix ">
		<h1>Evil Events</h1>
		<div class="contact">
			<div class="contact-info">
				<ul class="no-bullet">
					<li class="no-bullet">Telefoon: </li>
		<!--			<li>Telefoon: +31 6 553 964 33</li>-->
					<li>Email: <a href="mailto:info@evil-events.nl">info@evil-events.nl</a></li>
					<li><a class="fancybox fancybox.ajax" href="{{ URL::to('contact/add') }}">Contactformulier</a></li>
				</ul>
			</div>
			<div class="contact-avatar">
				<img class="img-rounded" src="img/eva.jpg"/>
			</div>
		</div>
	</section>

</div>
@stop
@section("footer")
@parent
@stop