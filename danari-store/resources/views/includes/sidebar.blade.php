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
            <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action active">Dashboard</a>
            <a href="/dashboard-products.html" class="list-group-item list-group-item-action">All Products</a>
            <a href="/dashboard-categories.html" class="list-group-item list-group-item-action">Categories</a>
            <a href="/dashboard-transactions.html" class="list-group-item list-group-item-action">Transactions</a>
            <a href="/dashboard-admin-users.html" class="list-group-item list-group-item-action">Users</a>
            <a href="/index.html" class="list-group-item list-group-item-action">Sign Out</a>
        </div>
    @endrole
    @role('seller')
        <div class="list-group list-group-flush">
            <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action active">Dashboard</a>
            <a href="/dashboard-products.html" class="list-group-item list-group-item-action">My Products</a>
            <a href="/dashboard-transactions.html" class="list-group-item list-group-item-action">Transaction Orders</a>
            <a href="/dashboard-store-settings.html" class="list-group-item list-group-item-action">Store Settings</a>
            <a href="/dashboard-account.html" class="list-group-item list-group-item-action">My Account</a>
            <a href="/index.html" class="list-group-item list-group-item-action">Sign Out</a>
        </div>
    @endrole
    @role('customer')
        <div class="list-group list-group-flush">
            <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action active">Dashboard</a>
            <a href="/dashboard-orders.html" class="list-group-item list-group-item-action">My Orders</a>
            <a href="/dashboard-transactions.html" class="list-group-item list-group-item-action">Transactions</a>
            <a href="/dashboard-account.html" class="list-group-item list-group-item-action">My Account</a>
            <a href="/index.html" class="list-group-item list-group-item-action">Sign Out</a>
        </div>
    @endrole
</div>
