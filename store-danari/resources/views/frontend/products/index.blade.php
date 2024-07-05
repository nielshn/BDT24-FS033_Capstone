@section('title', 'Products Store')

<x-app-layout>
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <x-slot name="header">
                <div class="items-center bg-indigo-100 px-6 py-4 rounded-md shadow-md">
                    <h2 class="text-2xl font-semibold text-indigo-900 leading-tight mb-2">My Products</h2>
                    <p class="text-0xl">Manage it well and get money</p>
                </div>
            </x-slot>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('products.create') }}" class="btn btn-success">Add New Product</a>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <a href="/dashboard-products-details.html" class="card card-dashboard-product d-block">
                            <div class="card-body">
                                <img src="/images/product-card-1.png" alt="product card" class="w-100 mb-2" />
                                <div class="product-title">Shirup Marzzan</div>
                                <div class="product-category">Foods</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <a href="/dashboard-product-details.html" class="card card-dashboard-product d-block">
                            <div class="card-body">
                                <img src="/images/product-card-2.png" alt="product card" class="w-100 mb-2" />
                                <div class="product-title">Shirup Marzzan</div>
                                <div class="product-category">Foods</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <a href="/dashboard-product-details.html" class="card card-dashboard-product d-block">
                            <div class="card-body">
                                <img src="/images/product-card-3.png" alt="product card" class="w-100 mb-2" />
                                <div class="product-title">Shirup Marzzan</div>
                                <div class="product-category">Foods</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <a href="/dashboard-product-details.html" class="card card-dashboard-product d-block">
                            <div class="card-body">
                                <img src="/images/product-card-4.png" alt="product card" class="w-100 mb-2" />
                                <div class="product-title">Shirup Marzzan</div>
                                <div class="product-category">Foods</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <a href="/dashboard-product-details.html" class="card card-dashboard-product d-block">
                            <div class="card-body">
                                <img src="/images/product-card-5.png" alt="product card" class="w-100 mb-2" />
                                <div class="product-title">Shirup Marzzan</div>
                                <div class="product-category">Foods</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
