@extends('layouts.frontend.main')
@section('title')
    Cart Page - DANARI STORE
@endsection

@section('content')
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
                                        <td style="width: 20%">
                                            @if ($cart->product->productGaleries)
                                                <img src="{{ Storage::url($cart->product->productGaleries->first()->photos) }}"
                                                    alt="" class="cart-image" />
                                            @endif
                                        </td>
                                        <td style="width: 30%">
                                            <div class="product-title">{{ $cart->product->name }}</div>
                                            <div class="product-subtitle">by {{ $cart->product->user->name }}</div>
                                        </td>
                                        <td style="width: 20%">
                                            <div class="product-title">${{ number_format($cart->product->price) }}
                                            </div>
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
                                                <button class="btn btn-remove-cart" type="submit">
                                                    Remove
                                                </button>
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
                <form action="#" id="locations" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country">Address 1</label>
                                <input type="text" class="form-control" id="address_one" name="address_one"
                                    value="Setra Duta Cemara" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address_two">Address 2</label>
                                <input type="text" class="form-control" id="address_two" name="address_two"
                                    value="Blok B2 No. 34" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="provinces_id">Province</label>
                                <select name="provinces_id" id="provinces_id" class="form-control" v-if="provinces"
                                    v-model="provinces_id">
                                    <option v-for="province in provinces" :value="province.id">@{{ province.name }}
                                    </option>
                                </select>
                                <select v-else class="from-control" id=""></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="regencies_id">City</label>
                                <select name="regencies_id" id="regencies_id" class="form-control" v-if="regencies"
                                    v-model="regencies_id">
                                    <option v-for="regency in regencies" :value="regency.id">@{{ regency.name }}
                                    </option>
                                </select>
                                <select v-else class="from-control" id=""></select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="zip_code">Postal Code</label>
                                <input type="text" class="form-control" id="zip_code" name="zip_code"
                                    value="Setra Duta Cemara" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" id="country" name="country"
                                    value="Indonesia" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone_number">Mobile</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number"
                                    value="+ 628 2020 111111" />
                            </div>
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
                    <div class="row" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-4 col-md-2">
                            <div class="product-title">$10</div>
                            <div class="product-subtitle">Country Tax</div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="product-title">$280</div>
                            <div class="product-subtitle">Product Insurance</div>
                        </div>
                        <div class="col-4 col-md-2">
                            <div class="product-title">$580</div>
                            <div class="product-subtitle">Ship to Jakarta</div>
                        </div>
                        <div class="col-4 col-md-2">
                            <div class="product-title text-success">${{ number_format($totalPrice) }}</div>
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
    <script>
        var locations = new Vue({
            el: "#locations",
            mounted() {
                AOS.init();
                this.getProvincesData();
            },
            data: {
                provinces: null,
                regencies: null,
                provinces_id: null,
                regencies_id: null
            },
            methods: {
                getProvincesData() {
                    var self = this;
                    axios.get('{{ route('api-provinces') }}')
                        .then(function(response) {
                            self.provinces = response.data;
                        })
                },
                getRegenciesData() {
                    var self = this;
                    axios.get('{{ url('regencies') }}/' + self.provinces_id)
                        .then(function(response) {
                            self.regencies = response.data;
                        })
                },
            },
            watch: {
                provinces_id: function(val, oldVal) {
                    this.regencies_id = null;
                    this.getRegenciesData();
                },
            }
        });


        document.addEventListener('DOMContentLoaded', function() {
            // quantity cart icon (+ -)
            document.querySelectorAll('.btn-decrement').forEach(button => {
                button.addEventListener('click', function() {
                    let quantityInput = this.nextElementSibling;
                    let currentQuantity = parseInt(quantityInput.value);
                    if (currentQuantity > 1) {
                        updateQuantity(this.dataset.id, currentQuantity - 1, quantityInput);
                    }
                });
            });

            document.querySelectorAll('.btn-increment').forEach(button => {
                button.addEventListener('click', function() {
                    let quantityInput = this.previousElementSibling;
                    let currentQuantity = parseInt(quantityInput.value);
                    let maxQuantity = parseInt(quantityInput.max);
                    if (currentQuantity < maxQuantity) {
                        updateQuantity(this.dataset.id, currentQuantity + 1, quantityInput);
                    }
                });
            });

            document.querySelectorAll('.form-remove-cart').forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    removeCartItem(this);
                });
            });
        });

        function updateQuantity(cartItemId, newQuantity, quantityInput) {
            fetch(`/cart-products/${cartItemId}/update-quantity`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        quantity: newQuantity
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        quantityInput.value = newQuantity;
                        // Update total price on the page, if needed
                        const totalPriceElement = quantityInput.closest('tr').querySelector('.product-total-price');
                        totalPriceElement.textContent = `$${(data.newTotalPrice)}`;
                    } else {
                        alert('Failed to update quantity.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function removeCartItem(form) {
            const action = form.action;
            fetch(action, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        form.closest('tr').remove();
                    } else {
                        alert('Failed to remove item from cart.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>
@endpush

@push('addon-style')
    <style>
        .quantity-control {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .quantity-control button {
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            width: 32px;
            height: 32px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        .quantity-control input {
            width: 50px;
            text-align: center;
            border: 1px solid #ced4da;
        }

        .btn-remove-cart {
            background-color: #e3342f;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .btn-remove-cart:hover {
            background-color: #cc1f1a;
        }

        .product-title {
            font-weight: bold;
        }

        .product-subtitle {
            color: #6c757d;
        }
    </style>
@endpush
