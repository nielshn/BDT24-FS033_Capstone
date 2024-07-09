@extends('layouts.frontend.main')

@section('title')
    Category Page - DANARI STORE
@endsection

@section('content')
    <div class="page-content page-home">
        <section class="store-trend-categories">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5>All Categories</h5>
                    </div>
                </div>
                <div class="row">
                    @foreach ($category->products as $product)
                        <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                            <a href="{{ route('front.details', $product->slug) }}" class="component-products d-block">
                                <div class="products-thumbnail">
                                    <div class="products-image"
                                        style="background-image: url('{{ $product->productGaleries->first() ? Storage::url($product->productGaleries->first()->photos) : 'images/no-image.jpg' }}');">
                                    </div>
                                </div>
                                <div class="products-text">{{ $product->name }}</div>
                                <div class="products-price">${{ number_format($product->price) }}</div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
