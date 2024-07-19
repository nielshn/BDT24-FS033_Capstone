@extends('layouts.frontend.main')
@section('title', $category->name . ' Category')

@section('content')
    <div class="page-content page-home">
        <input type="hidden" id="currentCategorySlug" value="{{ $category->slug }}">
        <input type="hidden" id="currentProductSlug" value="">
        {{-- <section class="store-trend-categories"> --}}
        <div class="container">
            <div class="row mb-4 align-items-center">
                {{-- <div class="col-12 d-flex justify-content-between align-items-center" data-aos="fade-up">
                        <h5>Category {{ $category->name }}</h5>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="categoryDropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Select Category
                            </button>
                            <div class="dropdown-menu" aria-labelledby="categoryDropdown">
                                @foreach ($categories as $category)
                                    <a class="dropdown-item category-filter"
                                        href="{{ route('front.category', $category->slug) }}"
                                        data-category="{{ $category->id }}">
                                        {{ $category->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div> --}}
                <div class="col-lg-12 d-flex justify-content-between align-items-center">
                    <h5>Category {{ $category->name }}</h5>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="categoryDropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Select Category
                        </button>
                        <div class="dropdown-menu" aria-labelledby="categoryDropdown">
                            @foreach ($categories as $category)
                                <a class="dropdown-item category-filter"
                                    href="{{ route('front.category', $category->slug) }}"
                                    data-category="{{ $category->id }}">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="product-list">
                @include('frontend.partials.products', ['products' => $products])
            </div>
        </div>
        {{-- </section> --}}
    </div>
@endsection
