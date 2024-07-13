@section('title', 'Transaction Details')

<x-app-layout>
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="items-center bg-gradient-to-r from-indigo-200 to-purple-300 px-4 py-2 rounded-md shadow-md">
                <h2 class="text-2xl font-semibold text-indigo-900 leading-tight mb-2">#{{ $transaction->code }}</h2>
                <p class="text-0xl"> Big result start from the small one</p>
            </div>
            <div class="dashboard-content mt-4" id="transactionDetails">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <img src="{{ Storage::url($transaction->details->first()->product->productGaleries->first()->photos ?? '') }}"
                                            alt="product-details-dashboard" class="w-100 mb-3" />
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Customer Name</div>
                                                <div class="product-subtitle">{{ $transaction->user->name }}</div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Product Name</div>
                                                <div class="product-subtitle">
                                                    {{ $transaction->details->first()->product->name }}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">
                                                    Date of Transaction
                                                </div>
                                                <div class="product-subtitle">
                                                    {{ $transaction->created_at->format('d M, Y') }}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Payment Status</div>
                                                <div class="product-subtitle text-danger">
                                                    {{ $transaction->transaction_status }}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Total Amount</div>
                                                <div class="product-subtitle">
                                                    ${{ number_format($transaction->total_price) }}</div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Mobile</div>
                                                <div class="product-subtitle">
                                                    {{ $transaction->user->phone_number }}
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
                                                @role('seller')
                                                    <select name="status" id="status" class="form-control"
                                                        v-model="status">
                                                        <option value="PENDING">Pending</option>
                                                        <option value="SHIPPING">Shipping</option>
                                                        <option value="SUCCESS">Success</option>
                                                    </select>
                                                @else
                                                    <select name="status" id="status" class="form-control" disabled>
                                                        <option value="PENDING"
                                                            {{ $transaction->shipping_status == 'PENDING' ? 'selected' : '' }}>
                                                            Pending</option>
                                                        <option value="SHIPPING"
                                                            {{ $transaction->shipping_status == 'SHIPPING' ? 'selected' : '' }}>
                                                            Shipping</option>
                                                        <option value="SUCCESS"
                                                            {{ $transaction->shipping_status == 'SUCCESS' ? 'selected' : '' }}>
                                                            Success</option>
                                                    </select>
                                                @endrole
                                            </div>
                                            @role('seller')
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
                                            @else
                                                <template v-if="status == 'SHIPPING'">
                                                    <div class="col-md-3 disabled">
                                                        <div class="product-title">Input Resi</div>
                                                        <input type="text" class="form-control" name="resi"
                                                            v-model="resi" disabled />
                                                    </div>
                                                </template>
                                            @endrole
                                        </div>
                                    </div>
                                </div>
                                @role('seller')
                                    <div class="row mt-4">
                                        <div class="col-12 text-right">
                                            <button type="submit" class="btn btn-success btn-lg">
                                                Save Now
                                            </button>
                                        </div>
                                    </div>
                                @endrole
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('addon-script')
        <script src="/vendor/vue/vue.js"></script>
        <script>
            var transactionDetails = new Vue({
                el: "#transactionDetails",
                data: {
                    status: "{{ $transaction->shipping_status }}",
                    resi: "{{ $transaction->resi ?? '' }}",
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
