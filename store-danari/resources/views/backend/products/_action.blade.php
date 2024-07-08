<div class="btn-group">
    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewProduct{{ $product->id }}">
        View
    </button>
</div>

<div class="modal fade" id="viewProduct{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="viewProduct{{ $product->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewProduct{{ $product->id }}Label">{{ $product->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        @if ($product->productGaleries->isNotEmpty())
                            <img src="{{ Storage::url($product->productGaleries->first()->photos) }}" class="img-fluid" alt="Product Image">
                        @else
                            <img src="{{ asset('images/default-product-image.png') }}" class="img-fluid" alt="Default Product Image">
                        @endif
                    </div>
                    <div class="col-md-6">
                        <h5>Description:</h5>
                        <p>{{ $product->description }}</p>
                        <h5>Price: ${{ number_format($product->price, 2) }}</h5>
                        <h5>Stock: {{ $product->stock }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
