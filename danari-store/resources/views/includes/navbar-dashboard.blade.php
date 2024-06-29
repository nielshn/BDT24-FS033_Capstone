<nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top" data-aos="fade-down">
    <div class="container-fluid">
        <button class="btn btn-secondary d-md-none mr-auto mr-2" id="menu-toggle">
            &laquo; Menu
        </button>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Desktop Menu -->
            <ul class="navbar-nav d-none d-lg-flex ml-auto">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link" id="navbarDropdown" role="button" data-toggle="dropdown">
                        <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="profile"
                            class="rounded-circle mr-2 profile-picture" />
                        Hi, {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu">
                        @role('admin')
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        @else
                            <a href="{{ route('front.home') }}" class="dropdown-item">Home</a>
                            <a href="/dashboard-account.html" class="dropdown-item">Settings</a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        @endrole
                    </div>
                </li>
                @role('admin')
                @else
                    <li class="nav-item">
                        <a href="{{ route('front.cart') }}" class="nav-link d-inline-block mt-2">
                            <img src="/images/icon-cart-filled.svg" alt="icon cart filled" />
                            <div class="card-badge">3</div>
                        </a>
                    </li>
                @endrole
            </ul>
            <ul class="navbar-nav d-block d-lg-none">
                <li class="nav-item">
                    <a href="#" class="nav-link">Hi {{ Auth::user()->name }}</a>
                </li>
                @role('admin')
                @else
                    <li class="nav-item">
                        <a href="#" class="nav-link d-inline-block">Cart</a>
                    </li>
                @endrole
            </ul>
        </div>
    </div>
</nav>
