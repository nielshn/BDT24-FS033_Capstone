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
            <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action">Dashboard</a>
            <a href="{{ route('products.index') }}" class="list-group-item list-group-item-action">All Products</a>
            <a href="{{ route('admin.categories.index') }}" class="list-group-item list-group-item-action">Categories</a>
            <a href="{{ route('transactions.index') }}" class="list-group-item list-group-item-action">Transactions</a>
            <a href="/dashboard-admin-users.html" class="list-group-item list-group-item-action">Users</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="route('logout')"
                    onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log Out') }}
                </a>
            </form>
        </div>
    @endrole
    @role('seller')
        <div class="list-group list-group-flush">
            <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action">Dashboard</a>
            <a href="{{ route('products.index') }}" class="list-group-item list-group-item-action">My Products</a>
            <a href="{{ route('transactions.index') }}" class="list-group-item list-group-item-action">Transaction
                Orders</a>
            <a href="{{ route('dashboard.storeSettings') }}" class="list-group-item list-group-item-action">Store
                Settings</a>
            <a href="{{ route('dashboard.accountSettings') }}" class="list-group-item list-group-item-action">My
                Account</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="route('logout')" class="list-group-item list-group-item-action"
                    onclick="event.preventDefault();
                                        this.closest('form').submit();">
                    {{ __('Log Out') }}
                </a>
            </form>
        </div>
    @endrole
    @role('customer')
        <div class="list-group list-group-flush">
            <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action">Dashboard</a>
            <a href="/dashboard-orders.html" class="list-group-item list-group-item-action">My Orders</a>
            <a href="{{ route('transactions.index') }}" class="list-group-item list-group-item-action">Transactions</a>
            <a href="{{ route('dashboard.accountSettings') }}" class="list-group-item list-group-item-action">My
                Account</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="route('logout')" class="list-group-item list-group-item-action"
                    onclick="event.preventDefault();
                                            this.closest('form').submit();">
                    {{ __('Log Out') }}
                </a>
            </form>
        </div>
    @endrole
</div>
