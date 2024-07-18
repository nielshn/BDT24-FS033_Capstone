@extends('layouts.frontend.main')
@section('title')
    Cart Page - DANARI STORE
@endsection

@section('content')
    @if (session('error'))
        <div class="notification-card error" id="pricing-error-message">
            <div>
                <span class="icon">⚠️</span>
                <span>{{ session('error') }}</span>
            </div>
            <button class="close-btn" onclick="closeMessage('pricing-error-message')">&times;</button>
        </div>
    @endif

    @if (isset($snapToken))
        <div class="notification-card info" id="midtrans-payment-card">
            <div>
                <span class="icon">💳</span>
                <span>Proceed to Payment</span>
            </div>
            <button class="close-btn" onclick="closeMessage('midtrans-payment-card')">&times;</button>
        </div>
    @endif


    <div class="page-content page-cart">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('front.home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Cart</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <section class="store-cart">
            <div class="container">
                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-12 table-responsive">
                        <table class="table table-borderless table-cart">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="select-all"></th>
                                    <th>Image</th>
                                    <th>Name &amp; Seller</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Menu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $cart)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="product-checkbox" data-id="{{ $cart->id }}"
                                                data-price="{{ $cart->product->price }}"
                                                data-quantity="{{ $cart->quantity }}">
                                        </td>
                                        <td style="width: 20%">
                                            @if ($cart->product->productGaleries)
                                                <img src="{{ Storage::url($cart->product->productGaleries->first()->photos) }}"
                                                    alt="" class="cart-image w-80" />
                                            @endif
                                        </td>
                                        <td style="width: 30%">
                                            <div class="product-title">{{ $cart->product->name }}</div>
                                            <div class="product-subtitle">by {{ $cart->product->user->name }}</div>
                                        </td>
                                        <td style="width: 20%">
                                            <div class="product-title">${{ number_format($cart->product->price) }}</div>
                                            <div class="product-subtitle">USD</div>
                                        </td>
                                        <td style="width: 14%">
                                            <div class="input-group quantity-control">
                                                <button class="btn btn-decrement" data-id="{{ $cart->id }}"
                                                    type="button">-</button>
                                                <input type="number" class="form-control text-center" name="quantity"
                                                    value="{{ $cart->quantity }}" min="1"
                                                    max="{{ $cart->product->stock }}" readonly>
                                                <button class="btn btn-increment" data-id="{{ $cart->id }}"
                                                    type="button">+</button>
                                            </div>
                                        </td>
                                        <td style="width: 20%">
                                            <form action="{{ route('cart-products.destroy', $cart->id) }}" method="POST"
                                                class="form-remove-cart">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-remove-cart" type="submit">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row" data-aos="fade-up" data-aos-delay="150">
                    <div class="col-12">
                        <hr />
                    </div>
                    <div class="col-12">
                        <h2 class="mb-4">Shipping Details</h2>
                    </div>
                </div>
                <form action="{{ route('checkout') }}" id="checkout-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="cart_ids" id="cart-ids" value="">
                    <input type="hidden" name="total_price" id="total-price" value="{{ $totalPrice }}">
                    <div class="row mb-1" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-12 col-md-4">
                            <div class="product-title">Address I</div>
                            <div class="product-subtitle">{{ $user->address->address_one ?? '' }}</div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="product-title">Address II</div>
                            <div class="product-subtitle">{{ $user->address->address_two ?? '' }}</div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="product-title">Province</div>
                            <div class="product-subtitle">
                                @if ($user->address && $user->address->provinces_id)
                                    {{ App\Models\Province::find($user->address->provinces_id)->name }}
                                @else
                                    (Belum diatur)
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1" data-aos="fade-up" data-aos-delay="250">
                        <div class="col-12 col-md-4">
                            <div class="product-title">City</div>
                            <div class="product-subtitle">
                                @if ($user->address && $user->address->regencies_id)
                                    {{ App\Models\Regency::find($user->address->regencies_id)->name }}
                                @else
                                    (Belum diatur)
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="product-title">Postal Code</div>
                            <div class="product-subtitle">{{ $user->address->zip_code ?? '' }}</div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="product-title">Country</div>
                            <div class="product-subtitle">{{ $user->address->country ?? '' }}</div>
                        </div>
                    </div>
                    <div class="row" data-aos="fade-up" data-aos-delay="150">
                        <div class="col-12">
                            <hr />
                        </div>
                        <div class="col-12">
                            <h2 class="mb-2">Payment Information</h2>
                        </div>
                    </div>
                    <div class="row" data-aos="fade-up" data-aos-delay="300">
                        <div class="col-4 col-md-2">
                            <div class="product-title">$0</div>
                            <div class="product-subtitle">Country Tax</div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="product-title">$0</div>
                            <div class="product-subtitle">Product Insurance</div>
                        </div>
                        <div class="col-4 col-md-2">
                            <div class="product-title">$0</div>
                            <div class="product-subtitle">Ship to Jakarta</div>
                        </div>
                        <div class="col-4 col-md-2">
                            <div class="product-title text-success" id="total-price-display">
                                ${{ number_format($totalPrice) }}
                            </div>
                            <div class="product-subtitle">Total</div>
                        </div>
                        <div class="col-8 col-md-3">
                            <button type="submit" class="btn btn-success mt-4 btn-block">Checkout Now</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productCheckboxes = document.querySelectorAll('.product-checkbox');
            const selectAllCheckbox = document.getElementById('select-all');
            const cartIdsInput = document.getElementById('cart-ids');
            const totalPriceInput = document.getElementById('total-price');
            const totalPriceDisplay = document.getElementById('total-price-display');
            let selectedCartIds = [];
            let totalPrice = 0;

            selectAllCheckbox.addEventListener('change', function() {
                selectedCartIds = [];
                totalPrice = 0;

                productCheckboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;

                    if (checkbox.checked) {
                        selectedCartIds.push(checkbox.dataset.id);
                        totalPrice += parseInt(checkbox.dataset.price) * parseInt(checkbox.dataset
                            .quantity);
                    }
                });

                cartIdsInput.value = selectedCartIds.join(',');
                totalPriceInput.value = totalPrice;
                totalPriceDisplay.textContent = `$${totalPrice.toLocaleString()}`;
            });

            productCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    if (checkbox.checked) {
                        selectedCartIds.push(checkbox.dataset.id);
                        totalPrice += parseInt(checkbox.dataset.price) * parseInt(checkbox.dataset
                            .quantity);
                    } else {
                        selectedCartIds = selectedCartIds.filter(id => id !== checkbox.dataset.id);
                        totalPrice -= parseInt(checkbox.dataset.price) * parseInt(checkbox.dataset
                            .quantity);
                    }

                    cartIdsInput.value = selectedCartIds.join(',');
                    totalPriceInput.value = totalPrice;
                    totalPriceDisplay.textContent = `$${totalPrice.toLocaleString()}`;
                });
            });

            const decrementButtons = document.querySelectorAll('.btn-decrement');
            const incrementButtons = document.querySelectorAll('.btn-increment');

            decrementButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const cartId = button.dataset.id;
                    const quantityInput = button.nextElementSibling;
                    let quantity = parseInt(quantityInput.value);

                    if (quantity > 1) {
                        quantity--;
                        quantityInput.value = quantity;

                        const checkbox = document.querySelector(
                            `.product-checkbox[data-id="${cartId}"]`);
                        if (checkbox.checked) {
                            totalPrice -= parseInt(checkbox.dataset.price);
                            totalPriceInput.value = totalPrice;
                            totalPriceDisplay.textContent = `$${totalPrice.toLocaleString()}`;
                        }
                    }
                });
            });

            incrementButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const cartId = button.dataset.id;
                    const quantityInput = button.previousElementSibling;
                    const maxQuantity = parseInt(quantityInput.max);
                    let quantity = parseInt(quantityInput.value);

                    if (quantity < maxQuantity) {
                        quantity++;
                        quantityInput.value = quantity;

                        const checkbox = document.querySelector(
                            `.product-checkbox[data-id="${cartId}"]`);
                        if (checkbox.checked) {
                            totalPrice += parseInt(checkbox.dataset.price);
                            totalPriceInput.value = totalPrice;
                            totalPriceDisplay.textContent = `$${totalPrice.toLocaleString()}`;
                        }
                    }
                });
            });
        });
    </script> --}}
    <script>
        const selectedCartItems = [];

        document.querySelectorAll('.product-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                updateSelectedItems(this);
            });
        });

        function updateSelectedItems(checkbox) {
            const cartId = checkbox.dataset.id;
            const price = parseFloat(checkbox.dataset.price);
            const quantity = parseInt(checkbox.dataset.quantity);

            if (checkbox.checked) {
                selectedCartItems.push({
                    id: cartId,
                    price: price,
                    quantity: quantity
                });
            } else {
                const index = selectedCartItems.findIndex(item => item.id == cartId);
                if (index > -1) {
                    selectedCartItems.splice(index, 1);
                }
            }
            updateTotalPrice();
            updateCartIds();
        }

        function updateTotalPrice() {
            let totalPrice = 0;
            selectedCartItems.forEach(item => {
                totalPrice += item.price * item.quantity;
            });
            document.getElementById('total-price-display').innerText = `$${totalPrice.toFixed(2)}`;
            document.getElementById('total-price').value = totalPrice.toFixed(2);
        }

        function updateCartIds() {
            const selectedIds = selectedCartItems.map(item => item.id).join(',');
            document.getElementById('cart-ids').value = selectedIds;
        }

        document.querySelectorAll('.btn-increment, .btn-decrement').forEach(button => {
            button.addEventListener('click', function() {
                updateQuantity(this);
            });
        });

        function updateQuantity(button) {
            const cartId = button.dataset.id;
            const inputField = button.parentNode.querySelector('input[name="quantity"]');
            let quantity = parseInt(inputField.value);

            if (button.classList.contains('btn-increment')) {
                quantity++;
            } else {
                if (quantity > 1) {
                    quantity--;
                }
            }

            inputField.value = quantity;
            const checkbox = document.querySelector(`.product-checkbox[data-id="${cartId}"]`);
            if (checkbox.checked) {
                const item = selectedCartItems.find(item => item.id == cartId);
                if (item) {
                    item.quantity = quantity;
                    updateTotalPrice();
                }
            }
        }
    </script>
@endpush
