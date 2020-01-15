<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="{{route('home')}}">
            <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28" alt="{{ config('app.name', 'Laravel') }}">
        </a>

        <a role="button" class="navbar-burger burger" :class="{'is-active': navbar.is_active}" @click="toggleNavbar" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu" :class="{'is-active': navbar.is_active}">
        <div class="navbar-start">
            {!! generateMenusMultiLevel($menus) !!}
        </div>

        <div class="navbar-end">

            <!-- Authentication Links -->
            @guest
                <a class="navbar-item" href="{{ route('login') }}">@lang('commons.login')</a>
                @if (Route::has('register'))
                    <a class="navbar-item" href="{{ route('register') }}">@lang('commons.register')</a>
                @endif
            @else
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                    {{ Auth::user()->name }}
                </a>

                <div class="navbar-dropdown">
                    <a class="navbar-item" href="{{ route('logout') }}">
                        @lang('commons.logout')
                    </a>
                </div>
            </div>
            @endguest

            <!-- Language links -->
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                    @lang('commons.language')
                </a>

                <div class="navbar-dropdown">
                    @forelse(config('language', []) as $localeCode => $language)
                        <a class="navbar-item {{isCurrentLocale($localeCode) ? 'is-active' : ''}}" href="{{route('setLanguage', $localeCode)}}">
                            @lang($language)
                        </a>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</nav>
