@php
    $incrementProduct = 0;
@endphp

@forelse ($products as $product)
    <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $incrementProduct += 100 }}">
        <a href="{{ route('front.details', $product->slug) }}" class="component-products d-block">
            <div class="products-thumbnail">
                <div class="products-image"
                    style="background-image: url('{{ $product->productGaleries->first() ? Storage::url($product->productGaleries->first()->photos) : 'images/no-image.jpg' }}');">
                </div>
            </div>
            <div class="products-text">{{ $product->name }}</div>
            <div class="products-price">${{ number_format($product->price, 2) }}</div>
        </a>
    </div>
@empty
    <p class="text-xl">Product belum tersedia</p>
@endforelse

<div class="mt-4 d-flex justify-content-center w-100">
    {{ $products->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
</div>
