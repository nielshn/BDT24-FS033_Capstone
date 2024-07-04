@section('title', 'Dashboard Store')
<x-app-layout>
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <x-slot name="header">
                <div class="items-center bg-indigo-100 px-4 py-3 rounded-md shadow-md">
                    <h2 class="text-2xl font-semibold text-indigo-900 leading-tight">
                        {{ Auth::user()->hasRole('admin') ? __('Admin Dashboard') : __('Dashboard') }}</h2>
                    @role('admin')
                        <p class="text-1xl font-semibold">Look what you have made today!</p>
                    @else
                        <p class="text-1xl font-semibold">Welcome to Dashboard</p>
                    @endrole
                </div>
            </x-slot>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="dashboard-card-title">Customer</div>
                                <div class="dashboard-card-subtitle">15,289</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="dashboard-card-title">Revenue</div>
                                <div class="dashboard-card-subtitle">$931,290</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="dashboard-card-title">Transaction</div>
                                <div class="dashboard-card-subtitle">22,409,399</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 mt-2">
                        <h5 class="mb-2" 3>Recent Transactions</h5>
                        <a href="/dashboard-transactions-details.html" class="card card-list d-block">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-1">
                                        <img src="/images/dashboard-icon-product-1.png" alt="icon product" />
                                    </div>
                                    <div class="col-md-4">Shirup Marzzan</div>
                                    <div class="col-md-3">Angga Risky</div>
                                    <div class="cl-md-3">12 Januari, 2020</div>
                                    <div class="col-md-1 d-none d-md-block">
                                        <img src="images/dashboard-arrow-right.svg" alt="arrow" />
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="/dashboard-transactions-details.html" class="card card-list d-block">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-1">
                                        <img src="/images/dashboard-icon-product-1.png" alt="icon product" />
                                    </div>
                                    <div class="col-md-4">LeBrone X</div>
                                    <div class="col-md-3">Masayoshi</div>
                                    <div class="cl-md-3">11 January, 2020</div>
                                    <div class="col-md-1 d-none d-md-block">
                                        <img src="images/dashboard-arrow-right.svg" alt="arrow" />
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="/dashboard-transactions-details.html" class="card card-list d-block">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-1">
                                        <img src="/images/dashboard-icon-product-1.png" alt="icon product" />
                                    </div>
                                    <div class="col-md-4">Soffa Lembutte</div>
                                    <div class="col-md-3">Shayna</div>
                                    <div class="cl-md-3">11 January, 2020</div>
                                    <div class="col-md-1 d-none d-md-block">
                                        <img src="images/dashboard-arrow-right.svg" alt="arrow" />
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
