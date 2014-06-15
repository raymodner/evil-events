@section("header")
<div class="header">

	<div class="container header-container">
		<img class="logo" src="img/logo.png" width="100px"/>

		<div class='navbar navbar-inverse'>

			<div class='navbar-inner nav-collapse'>
				<ul class="nav large-nav">
					<li @if($section == 'home') class="active" @endif><a href="{{ URL::to('home') }}">Home</a></li>
					<li @if($section == 'event') class="active" @endif><a href="{{ URL::to('evenementen') }}">Evenementen</a></li>
					<li @if($section == 'report') class="active" @endif><a href="{{ URL::to('portfolio') }}">Portfolio</a></li>
					<li @if($section == 'contact') class="active" @endif><a href="{{ URL::to('contact') }}">Contact</a></li>
				</ul>
				<ul class="nav small-nav">
					<li @if($section == 'home') class="active" @endif><a href="{{ URL::to('home') }}"><i class="icon-home"></i></a></li>
					<li @if($section == 'event') class="active" @endif><a href="{{ URL::to('evenementen') }}"><i class="icon-calendar"></i></a></li>
					<li @if($section == 'report') class="active" @endif><a href="{{ URL::to('portfolio') }}"><i class="icon-picture"></i></a></li>
					<li @if($section == 'contact') class="active" @endif><a href="{{ URL::to('contact') }}"><i class="icon-user"></i></a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function resizeNav(){
		if (window.innerWidth < 720) {
			$(".large-nav").hide();
			$(".small-nav").show();
		}else{
			$(".large-nav").show();
			$(".small-nav").hide();
		}
	}


	$(window).resize(function(){
		resizeNav();
	});

	resizeNav();



</script>


@show