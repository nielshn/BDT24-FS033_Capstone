<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Button Menu Toggle -->
                <button class="btn btn-secondary d-md-none ml-2" id="menu-toggle">
                    &laquo; Menu
                </button>
                <!-- Navbar Toggler (for mobile) -->
                <button class="navbar-toggler ml-2" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open=!open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Navigation Links -->
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-nav-link>
                @role('admin')
                    <x-nav-link :href="route('admin.allproducts.index')" :active="request()->is('admin/products*')">
                        {{ __('All Products') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.index')">
                        {{ __('Categories') }}
                    </x-nav-link>
                    <x-nav-link :href="route('transactions.index')" :active="request()->is('transactions*')">
                        {{ __('Transactions') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')">
                        {{ __('All Users') }}
                    </x-nav-link>
                @endrole
                @role('seller')
                    <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')">
                        {{ __('My Products') }}
                    </x-nav-link>
                    <x-nav-link :href="route('transactions.index')" :active="request()->is('transactions*')">
                        {{ __('Transactions') }}
                    </x-nav-link>
                    <x-nav-link :href="route('store-settings.index')" :active="request()->routeIs('store-settings.index')">
                        {{ __('Store Settings') }}
                    </x-nav-link>
                    <x-nav-link :href="route('account-settings.index')" :active="request()->routeIs('account-settings.index')">
                        {{ __('My Account') }}
                    </x-nav-link>
                @endrole
                @role('customer')
                    <x-nav-link href="#">
                        {{ __('My Orders') }}
                    </x-nav-link>
                    <x-nav-link :href="route('transactions.index')" :active="request()->is('transactions*')">
                        {{ __('Transactions') }}
                    </x-nav-link>
                    <x-nav-link :href="route('account-settings.index')" :active="request()->routeIs('account-settings.index')">
                        {{ __('My Account') }}
                    </x-nav-link>
                @endrole
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @role('admin')
                @else
                    <ul class="navbar-nav d-none d-lg-flex mr-2">
                        <li class="nav-item">
                            <a href="{{ route('cart-products.index') }}" class="nav-link d-inline-block mt-2 relative">
                                @php
                                    $carts = \App\Models\Cart::where('users_id', Auth::user()->id)->count();
                                @endphp
                                @if ($carts > 0)
                                    <img src="/images/icon-cart-filled.svg" alt="icon cart filled" class="h-6 w-6" />
                                    <span
                                        class="absolute top-0 right-0 bg-green-600 text-white rounded-full px-2 py-1 text-xs">
                                        {{ $carts }}</span>
                                @else
                                    <img src="/images/icon-cart-empty.svg" alt="icon cart empty" />
                                @endif
                            </a>
                        </li>
                    </ul>
                    <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="profile"
                        class="rounded-full h-8 w-8 flex-shrink-0 mr-4" />
                @endrole
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center text-sm font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ml-1">
                                <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @role('admin')
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        @else
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <a href="{{ route('front.home') }}" class="dropdown-item">Home</a>
                            <a href="{{ route('account-settings.index') }}" class="dropdown-item">Settings</a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        @endrole
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                @role('admin')
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                @else
                    <x-responsive-nav-link :href="route('cart-products.index')">
                        {{ __('Cart') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                @endrole
            </div>
        </div>
    </div>
</nav>
