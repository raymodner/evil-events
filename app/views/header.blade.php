@section("header")
    <div class="header">

		<div class="container">
			<img class="logo" src="img/logo.png" width="100px"/>

			<div class='navbar navbar-inverse'>

				<div class='navbar-inner nav-collapse'>
					<ul class="nav">
						<li @if($section == 'home') class="active" @endif><a href="{{ URL::to('home') }}">Home</a></li>
						<li @if($section == 'event') class="active" @endif><a href="{{ URL::to('evenementen') }}">Evenementen</a></li>
						<li @if($section == 'report') class="active" @endif><a href="{{ URL::to('portfolio') }}">Portfolio</a></li>
						<li @if($section == 'contact') class="active" @endif><a href="{{ URL::to('contact') }}">Contact</a></li>
					</ul>
				</div>
			</div>
        </div>
    </div>
@show