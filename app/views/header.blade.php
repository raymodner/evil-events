@section("header")
    <div class="header">
        <div class="container">
            <h1>Laravel startup</h1>
            @if (Auth::check())
                <a href="{{ URL::route("user/logout") }}">
                    Logout
                </a>
             @else
                <a href="{{ URL::route("user/login") }}">
                    Login
                </a>
            @endif
            <nav >
                @if (Auth::check())
                    <a href="{{ URL::route("user/profile") }}">
                        Profile
                    </a>
                    <a href="{{ URL::route("media/list", array('user' => Auth::user()->id)) }}">
                        Mijn media
                    </a>
                @endif
                <a href="{{ URL::route("blog") }}">
                    Blogs
                </a>
            </nav>
        </div>
    </div>
@show