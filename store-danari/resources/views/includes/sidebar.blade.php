<div class="border-right" id="sidebar-wrapper">
    <div class="sidebar-heading text-center">
        @if (Auth::user()->hasRole('admin'))
            <img src="/images/admin.png" alt="logo-dashboard" class="my-4" style="max-width: 120px">
        @else
            <img src="/images/dashboard-store-logo.svg" class="my-4" alt="logo dashboard" />
        @endif
    </div>
    @role('admin')
        <div class="list-group list-group-flush">
            <a href="{{ route('dashboard') }}"
                class="list-group-item list-group-item-action {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('admin.allproducts.index') }}"
                class="list-group-item list-group-item-action {{ request()->is('admin/products*') ? 'active' : '' }}">All
                Products</a>
            <a href="{{ route('admin.categories.index') }}"
                class="list-group-item list-group-item-action {{ request()->is('admin/categories*') ? 'active' : '' }}">Categories</a>
            <a href="{{ route('transactions.index') }}"
                class="list-group-item list-group-item-action {{ request()->is('transactions*') ? 'active' : '' }}">Transactions</a>
            <a href="{{ route('admin.users.index') }}"
                class="list-group-item list-group-item-action {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">All Users</a>
            <form method="POST" action="{{ route('logout') }}" class="list-group-item list-group-item-action">
                @csrf
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </a>
            </form>
        </div>
    @endrole
    @role('seller')
        <div class="list-group list-group-flush">
            <a href="{{ route('dashboard') }}"
                class="list-group-item list-group-item-action {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('products.index') }}"
                class="list-group-item list-group-item-action {{ request()->is('products*') ? 'active' : '' }}">My
                Products</a>
            <a href="{{ route('transactions.index') }}"
                class="list-group-item list-group-item-action {{ request()->is('transactions*') ? 'active' : '' }}">Transactions
            </a>
            <a href="{{ route('store-settings.index') }}"
                class="list-group-item list-group-item-action {{ request()->routeIs('store-settings.index') ? 'active' : '' }}">Store
                Settings</a>
            <a href="{{ route('account-settings.index') }}"
                class="list-group-item list-group-item-action {{ request()->routeIs('account-settings.index') ? 'active' : '' }}">My
                Account</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" class="list-group-item list-group-item-action"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </a>
            </form>
        </div>
    @endrole
    @role('customer')
        <div class="list-group list-group-flush">
            <a href="{{ route('dashboard') }}"
                class="list-group-item list-group-item-action {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="#"
                class="list-group-item list-group-item-action {{ request()->is('dashboard-orders*') ? 'active' : '' }}">My
                Orders</a>
            <a href="{{ route('transactions.index') }}"
                class="list-group-item list-group-item-action {{ request()->is('transactions*') ? 'active' : '' }}">Transactions</a>
            <a href="{{ route('account-settings.index') }}"
                class="list-group-item list-group-item-action {{ request()->routeIs('account-settings.index') ? 'active' : '' }}">My
                Account</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" class="list-group-item list-group-item-action"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </a>
            </form>
        </div>
    @endrole
</div>
