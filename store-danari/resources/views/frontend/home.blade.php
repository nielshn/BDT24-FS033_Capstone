@extends('layouts.frontend.main')
@section('title', 'Home Page')

@section('content')
    <div class="page-content page-home">
        <input type="hidden" id="currentCategorySlug" value="">
        <input type="hidden" id="currentProductSlug" value="">
        <!-- Store Carousel -->
        <section class="store-carousel">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12" data-aos="zoom-in">
                        <div id="storeCarousel" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li class="active" data-target="#storeCarousel" data-slide-to="0"></li>
                                <li data-target="#storeCarousel" data-slide-to="1"></li>
                                <li data-target="#storeCarousel" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="/images/banner.jpg" alt="Carousel" class="d-block w-100" />
                                </div>
                                <div class="carousel-item">
                                    <img src="/images/banner.jpg" alt="Carousel" class="d-block w-100" />
                                </div>
                                <div class="carousel-item">
                                    <img src="/images/banner.jpg" alt="Carousel" class="d-block w-100" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Trend Categories -->
        <section class="store-trend-categories">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5>Trend Categories</h5>
                    </div>
                </div>
                <div class="row">
                    @php
                        $incrementCategory = 0;
                    @endphp
                    @forelse ($categories as $category)
                        <div class="col-6 col-md-3 col-lg-2" data-aos="fade-up"
                            data-aos-delay="{{ $incrementCategory += 100 }}">
                            <a href="{{ route('front.category', $category->slug) }}" class="component-categories d-block">
                                <div class="categories-image">
                                    <img src="{{ Storage::url($category->icon) }}" alt="categories-gadgets"
                                        class="w-100" />
                                </div>
                                <p class="categories-text">{{ $category->name }}</p>
                            </a>
                        </div>
                    @empty
                        <p>Category belum ada</p>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- New Products -->
        <section class="store-new-products">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5>New Products</h5>
                    </div>
                </div>
                <div id="product-list" class="row">
                    @include('frontend.partials.products', ['products' => $products])
                </div>
            </div>
        </section>
    </div>
@endsection
