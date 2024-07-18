@extends('layouts.frontend.main')
@section('title', $product->name)

@section('content')
    <div class="page-content page-details">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('front.home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Product Details</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <section class="store-gallery mb-4" id="gallery">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8" data-aos="zoom-in">
                        <transition name="slide-fade" mode="out-in">
                            <img :src="photos[activePhoto].url" :key="photos[activePhoto].id" class="w-100 main-image"
                                alt="" />
                        </transition>
                    </div>
                    <div class="col-lg-2">
                        <div class="row">
                            <div class="col-3 col-lg-12 mt-2 mt-lg-0" v-for="(photo, index) in photos"
                                :key="photo.id" data-aos="zoom-in" data-aos-delay="100">
                                <a href="#" @click="changeActive(index)">
                                    <img :src="photo.url" class="w-100 thumbnail-image"
                                        :class="{ active: index == activePhoto }" alt="" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="store-details-container" data-aos="fade-up">
            <section class="store-heading">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <h1>{{ $product->name }}</h1>
                            <div class="owner">{{ $product->user->name }}</div>
                            <div class="owner">Stock: {{ $product->stock }}</div>
                            <div class="price">${{ number_format($product->price) }}</div>
                        </div>

                        <div class="col-lg-2" data-aos="zoom-in">
                            @auth
                                <form action="{{ route('cart-products.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="products_id" value="{{ $product->id }}">
                                    <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <input type="number" class="form-control" name="quantity" id="quantity" value="1"
                                            min="1" max="{{ $product->stock }}">
                                </div>
                                    <button class="btn btn-success px-4 text-white btn-block mb-3">Add to Cart</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-success px-4 text-white btn-block mb-3">
                                    Sign in to Add
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </section>

            <section class="store-description">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            {!! $product->description !!}
                        </div>
                    </div>
                </div>
            </section>

            <section class="store-review">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-8 mb-3">
                            <h5>Customer Review (3)</h5>
                        </div>
                        <div class="col-12 col-lg-8">
                            <ul class="list-unstyled">
                                <li class="media">
                                    <img src="/images/icon-testimonial-1.png" alt="" class="mr-3 rounded-circle" />
                                    <div class="media-body">
                                        <h5 class="mt-2 mb-1">Hazza Risky</h5>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero eveniet aspernatur
                                        ipsa, officia impedit!
                                    </div>
                                </li>
                                <li class="media">
                                    <img src="/images/icon-testimonial-2.png" alt="" class="mr-3 rounded-circle" />
                                    <div class="media-body">
                                        <h5 class="mt-2 mb-1">Hazza Risky</h5>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero eveniet aspernatur
                                        ipsa, officia impedit!
                                    </div>
                                </li>
                                <li class="media">
                                    <img src="/images/icon-testimonial-3.png" alt="" class="mr-3 rounded-circle" />
                                    <div class="media-body">
                                        <h5 class="mt-2 mb-1">Hazza Risky</h5>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero eveniet aspernatur
                                        ipsa, officia impedit!
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <section class="store-new-products">
                <div class="container">
                    <div class="row">
                        <div class="col-12" data-aos="fade-up">
                            <h5>Related Products</h5>
                        </div>
                    </div>
                    <div class="row" z>
                        <div id="relatedProductsCarousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($relatedProducts->chunk(4) as $index => $chunk)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <div class="row">
                                            @foreach ($chunk as $relatedProduct)
                                                <div class="col-6 col-md-3">
                                                    <a href="{{ route('front.details', $relatedProduct->slug) }}"
                                                        class="component-products d-block">
                                                        <div class="products-thumbnail">
                                                            <div class="products-image"
                                                                style="background-image: url('{{ $relatedProduct->productGaleries->first() ? Storage::url($relatedProduct->productGaleries->first()->photos) : 'images/no-image.jpg' }}');">
                                                            </div>
                                                        </div>
                                                        <div class="products-text">{{ $relatedProduct->name }}</div>
                                                        <div class="products-price">
                                                            ${{ number_format($relatedProduct->price) }}</div>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#relatedProductsCarousel" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#relatedProductsCarousel" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}

    <script>
        var gallery = new Vue({
            el: "#gallery",
            mounted() {
                AOS.init();
            },
            data: {
                activePhoto: 0,
                photos: [
                    @foreach ($product->productGaleries as $gallery)
                        {
                            id: {{ $gallery->id }},
                            url: "{{ Storage::url($gallery->photos) }}",
                        },
                    @endforeach
                ],
            },
            methods: {
                changeActive(id) {
                    this.activePhoto = id;
                },
            },
        });
    </script>
@endpush

{{-- @push('prepend-style')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .main-image {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .thumbnail-image {
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .thumbnail-image.active {
            border: 2px solid #f8b600;
        }

        .products-thumbnail {
            position: relative;
            overflow: hidden;
            border-radius: 15px;
            box-shadow: 6px 6px 12px rgba(0, 0, 0, 0.1), -6px -6px 12px rgba(255, 255, 255, 0.5);
            transition: all 0.3s ease;
        }

        .products-thumbnail:hover {
            transform: translateY(-5px);
            box-shadow: 10px 10px 20px rgba(0, 0, 0, 0.2), -10px -10px 20px rgba(255, 255, 255, 0.7);
        }

        .products-image {
            padding-top: 100%;
            background-size: cover;
            background-position: center;
        }

        .products-text,
        .products-price {
            text-align: center;
            margin-top: 10px;
        }

        .products-price {
            color: #e91e63;
            font-weight: bold;
        }

        .store-details-container {
            padding-top: 60px;
        }
    </style>
@endpush --}}
