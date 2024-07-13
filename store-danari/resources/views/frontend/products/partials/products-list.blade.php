<div class="row mt-4">
    @foreach ($products as $product)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <a href="{{ route('products.edit', $product) }}" class="card card-dashboard-product d-block">
                <div class="card-body">
                    @if ($product->productGaleries->isNotEmpty())
                        <img src="{{ Storage::url($product->productGaleries->first()->photos) }}" alt="product card"
                            class="w-100 mb-2" />
                    @else
                        <img src="{{ asset('images/default-product-image.png') }}" alt="default product card"
                            class="w-100 mb-2" />
                    @endif
                    <div class="product-title">{{ $product->name }}</div>
                    <div class="product-category">{{ $product->category->name }}</div>
                </div>
            </a>
        </div>
    @endforeach
</div>
<div class="row mt-4">
    <div class="col-12">
        {{ $products->links() }} <!-- Pagination links -->
    </div>
</div>
