@section('title', 'Transaction Details')

<x-app-layout>
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <x-slot name="header">
                <div class="items-center bg-indigo-100 px-6 py-4 rounded-md shadow-md">
                    <h2 class="text-2xl font-semibold text-indigo-900 leading-tight mb-2">#STORE0839</h2>
                    <p class="text-0xl"> Big result start from the small one</p>
                </div>
            </x-slot>
            <div class="dashboard-content" id="transactionDetails">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <img src="images/product-details-dashboard.png" alt="product-details-dashboard"
                                            class="w-100 mb-3" />
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Customer Name</div>
                                                <div class="product-subtitle">Angga Risky</div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Product Name</div>
                                                <div class="product-subtitle">
                                                    Shirup Marzzan
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">
                                                    Date of Transaction
                                                </div>
                                                <div class="product-subtitle">
                                                    12 Januari, 2020
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Payment Status</div>
                                                <div class="product-subtitle text-danger">
                                                    Pending
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Total Amount</div>
                                                <div class="product-subtitle">$280,409</div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Mobile</div>
                                                <div class="product-subtitle">
                                                    +628 2020 11111
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mt-4">
                                        <h5>Shipping Information</h5>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Address I</div>
                                                <div class="product-subtitle">
                                                    Setra Duta Cemara
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Address II</div>
                                                <div class="product-subtitle">
                                                    Blok B2 No. 34
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Province</div>
                                                <div class="product-subtitle">West Java</div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">City</div>
                                                <div class="product-subtitle">Bandung</div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Postal Code</div>
                                                <div class="product-subtitle">123999</div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Country</div>
                                                <div class="product-subtitle">Indonesia</div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="product-title">Shipping Status</div>
                                                <select name="status" id="status" class="form-control"
                                                    v-model="status">
                                                    <option value="PENDING">Pending</option>
                                                    <option value="SHIPPING">Shipping</option>
                                                    <option value="SUCCESS">Success</option>
                                                </select>
                                            </div>
                                            <template v-if="status == 'SHIPPING'">
                                                <div class="col-md-3">
                                                    <div class="product-title">Input Resi</div>
                                                    <input type="text" class="form-control" name="resi"
                                                        v-model="resi" />
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="submit" class="btn btn-success btn-block mt-4">
                                                        Update Resi
                                                    </button>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12 text-right">
                                        <button type="submit" class="btn btn-success btn-lg">
                                            Save Now
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('addon-script')
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script> --}}
        <script src="/vendor/vue/vue.js"></script>
        <script>
            var transactionDetails = new Vue({
                el: "#transactionDetails",
                data: {
                    status: "SHIPPING",
                    resi: "JNE20839149021029301231",
                },
                created: function() {
                    this.getTransactions();
                },
                methods: {
                    getTransactions: function() {
                        axios
                            .get("http://localhost:3000/transactions")
                            .then((response) => {
                                this.transactions = response.data;
                            })
                            .catch((error) => {
                                console.log(error);
                            });
                    },
                },
            });
        </script>
    @endpush

</x-app-layout>

{{-- @push('addon-style')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
@endpush --}}
