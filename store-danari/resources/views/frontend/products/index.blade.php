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

            @include('layouts.backend.session-message')
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('products.create') }}" class="btn btn-success">Add New Product</a>
                    </div>
                </div>
                <div class="row mt-4">
                    @foreach ($products as $product)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <a href="{{ route('products.edit', $product) }}"
                                class="card card-dashboard-product d-block">
                                <div class="card-body">
                                    @if ($product->productGaleries->isNotEmpty())
                                        <img src="{{ Storage::url($product->productGaleries->first()->photos) }}"
                                            alt="product card" class="w-100 mb-2" />
                                    @else
                                        <img src="{{ asset('images/default-product-image.png') }}"
                                            alt="default product card" class="w-100 mb-2" />
                                    @endif
                                    <div class="product-title">{{ $product->name }}</div>
                                    <div class="product-category">{{ $product->category->name }}</div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
