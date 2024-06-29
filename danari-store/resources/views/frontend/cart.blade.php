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
                                    <th>Menu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width: 20%">
                                        <img src="/images/product-cart-1.jpg" alt="product cart" class="cart-image" />
                                    </td>
                                    <td style="width: 35%">
                                        <div class="product-title">Sofa Ternyaman</div>
                                        <div class="product-subtitle">by Dony</div>
                                    </td>
                                    <td style="width: 35%">
                                        <div class="product-title">$29,122</div>
                                        <div class="product-subtitle">USD</div>
                                    </td>
                                    <td style="width: 20%">
                                        <a href="#" class="btn btn-remove-cart">Remove</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%">
                                        <img src="/images/product-cart-2.jpg" alt="product cart" class="cart-image" />
                                    </td>
                                    <td style="width: 35%">
                                        <div class="product-title">Sneaker</div>
                                        <div class="product-subtitle">by Daniel</div>
                                    </td>
                                    <td style="width: 35%">
                                        <div class="product-title">$80,309</div>
                                        <div class="product-subtitle">USD</div>
                                    </td>
                                    <td style="width: 20%">
                                        <a href="#" class="btn btn-remove-cart">Remove</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%">
                                        <img src="/images/product-cart-3.jpg" alt="product cart" class="cart-image" />
                                    </td>
                                    <td style="width: 35%">
                                        <div class="product-title">Coffee Holder</div>
                                        <div class="product-subtitle">by Rizky</div>
                                    </td>
                                    <td style="width: 35%">
                                        <div class="product-title">$13,492</div>
                                        <div class="product-subtitle">USD</div>
                                    </td>
                                    <td style="width: 20%">
                                        <a href="#" class="btn btn-remove-cart">Remove</a>
                                    </td>
                                </tr>
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
                <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="country">Address 1</label>
                            <input type="text" class="form-control" id="addressOne" name="addressOne"
                                value="Setra Duta Cemara" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="adressTwo">Address 2</label>
                            <input type="text" class="form-control" id="adressTwo" name="adressTwo"
                                value="Blok B2 No. 34" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="province">Province</label>
                            <select name="province" id="province" class="form-control">
                                <option value="West Java">West Java</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="city">City</label>
                            <select name="city" id="city" class="form-control">
                                <option value="Bandung">Bandung</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="postalCode">Postal Code</label>
                            <input type="text" class="form-control" id="postalCode" name="postalCode"
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
                            <label for="mobile">Mobile</label>
                            <input type="text" class="form-control" id="mobile" name="mobile"
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
                        <div class="product-title text-success">$392, 409</div>
                        <div class="product-subtitle">Total</div>
                    </div>
                    <div class="col-8 col-md-3">
                        <a href="{{ route('front.success') }}" class="btn btn-success mt-4 btn-block">
                            Checkout Now</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
