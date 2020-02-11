<nav>
    <div class="inner">
        <ul class="centerAll">
            <li>
                <a href="/">
                    {{ config('app.name', 'Munki') }}
                </a>
            </li>
            <li><a id="createPostButton" href="/upload">NEW POST</a></li>
            <li>NEW</li>
            <li>POPULAR</li>
        </ul>
        <form>
            <input placeholder="SEARCH FOR POST" class="textInput" type="text" name="" id=""/>
        </form>
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