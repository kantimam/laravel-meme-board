<nav {{-- class="mainColor" --}}>
    <div class="inner">
        <ul class="centerAll postNav">
            <li>
                <a id="navLogo"  href="/">
                        {{ config('app.name', 'Munki') }}
                </a>
            </li>
            <li class="newPost">
                <a class="{{ request()->is( 'upload*' ) ? 'activeCreate' : '' }}" id="createPostButton" href="/upload">
                    NEW POST
                </a>
            </li>
            <li>
                <a class="{{ Request::is( 'new*' ) ||  Request::is( '/*' )? 'active' : '' }}" href="/new">
                    NEW
                </a>
            </li>
            <li>
                <a class="{{ Request::is( 'popular*' ) ? 'active' : '' }}" href="/popular">
                    POPULAR
                </a>
            </li>
        </ul>
        @include('components.searchBar')
        <div id="userNav">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
            <li id="profileLogOutWrapper">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ route('profile')}}">
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    <input type="submit" value="LOGOUT">
                    @csrf
                </form>
            </li>
        @endguest
            
        </div>
    </div>
</nav>