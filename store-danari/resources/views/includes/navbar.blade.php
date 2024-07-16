<nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top" data-aos="fade-down">
    <div class="container">
        <a href="{{ route('front.home') }}" class="navbar-brand">
            <img src="/images/logo.svg" alt="Logo" />
        </a>
        @if (!request()->routeIs('login') && !request()->routeIs('register'))
            <form id="searchForm" class="form-inline my-2 my-lg-0 ml-3">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
                    name="search" id="searchInput">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        @endif
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ request()->routeIs('front.home') ? 'active' : '' }}">
                    <a href="{{ route('front.home') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item {{ request()->routeIs('front.products') ? 'active' : '' }}">
                    <a href="{{ route('front.products') }}" class="nav-link">All Products</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Rewards</a>
                </li>
                @guest
                    @if (!request()->routeIs('login') && !request()->routeIs('register'))
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link">Sign Up</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="btn btn-success nav-link">Sign In</a>
                        </li>
                    @endif
                @endguest
            </ul>
            @auth
                <ul class="navbar-nav d-none d-lg-flex">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link" id="navbarDropdown" role="button" data-toggle="dropdown">
                            <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="profile"
                                class="rounded-circle mr-2 profile-picture" />
                            Hi, {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu">
                            <a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard</a>
                            <a href="{{ route('account-settings.index') }}" class="dropdown-item">Settings</a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cart-products.index') }}" class="nav-link d-inline-block mt-2">
                            @php
                                $carts = \App\Models\Cart::where('users_id', Auth::user()->id)->count();
                            @endphp
                            @if ($carts > 0)
                                <img src="/images/icon-cart-filled.svg" alt="icon cart filled" />
                                <div class="card-badge">{{ $carts }}</div>
                            @else
                                <img src="/images/icon-cart-empty.svg" alt="icon cart empty" />
                            @endif
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav d-block d-lg-none">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link"> Hi, {{ Auth::user()->name }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cart-products.index') }}" class="nav-link d-inline-block">
                            @php
                                $carts = \App\Models\Cart::where('users_id', Auth::user()->id)->count();
                            @endphp
                            Cart @if ($carts > 0)
                                ({{ $carts }})
                            @endif
                        </a>
                    </li>
                </ul>
            @endauth
        </div>
    </div>
</nav>
