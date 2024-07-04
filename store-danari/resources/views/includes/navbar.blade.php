<nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top" data-aos="fade-down">
    <div class="container">
        <a href="{{ route('front.home') }}" class="navbar-brand">
            <img src="images/logo.svg" alt="Logo" /></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a href="{{ route('front.home') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('front.category') }}" class="nav-link">Categories</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Rewards</a>
                </li>
                @guest
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link">Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-success nav-link">Sign In</a>
                    </li>
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
                            <a href="{{ route('dashboard.accountSettings') }}" class="dropdown-item">Settings</a>
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
                        <div class="nav-link d-inline-block mt-2">
                            <a href="{{ route('front.cart') }}"> <img src="/images//icon-cart-empty.svg"
                                    alt="icon cart empty" /></a>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav d-block d-lg-none">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link"> Hi, {{ Auth::user()->name }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('front.cart') }}" class="nav-link d-inline-block">Cart</a>
                    </li>
                </ul>
            @endauth

        </div>
    </div>
</nav>
