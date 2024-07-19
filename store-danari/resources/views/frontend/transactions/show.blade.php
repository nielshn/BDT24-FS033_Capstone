@section('title', 'Transaction Details')

<x-app-layout>
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        @include('layouts.backend.session-message')
        <div class="container-fluid">
            <div class="items-center bg-gradient-to-r from-indigo-200 to-purple-300 px-4 py-2 rounded-md shadow-md">
                <h2 class="text-2xl font-semibold text-indigo-900 leading-tight mb-2">
                    #{{ $transaction->code }}
                </h2>
                <p class="text-0xl">Big result start from the small one</p>
            </div>
            <div class="dashboard-content mt-4" id="transactionDetails">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                @role('customer')
                                    @foreach ($transaction->details as $detail)
                                        <div class="row mb-4">
                                            <div class="col-12 col-md-4">
                                                <img src="{{ Storage::url($detail->product->productGaleries->first()->photos ?? '') }}"
                                                    alt="product-details-dashboard" class="w-100 mb-3" />
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <div class="row">
                                                    <div class="col-12 col-md-6">
                                                        <div class="product-title">Username</div>
                                                        <div class="product-subtitle">
                                                            {{ $transaction->user->name }}
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="product-title">Product Name</div>
                                                        <div class="product-subtitle">
                                                            {{ $detail->product->name }}
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="product-title">Date of Transaction</div>
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
                                                        <div class="product-title">Price</div>
                                                        <div class="product-subtitle">
                                                            ${{ number_format($detail->product->price) }}
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="product-title">Shipping Status</div>
                                                        <div class="product-subtitle">
                                                            {{ $detail->shipping_status }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    {{-- <div class="row mt-4">
                                        <div class="col-12 text-right">
                                            <h5>
                                                Total Amount: ${{ number_format($transaction->total_price) }}
                                            </h5>
                                        </div>
                                    </div> --}}
                                @endrole
                                @role('seller|admin')
                                    <div class="row mb-4">
                                        <div class="col-12 col-md-4">
                                            <img src="{{ Storage::url($transaction->details->first()->product->productGaleries->first()->photos ?? '') }}"
                                                alt="product-details-dashboard" class="w-100 mb-3" />
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="product-title">Customer Name</div>
                                                    <div class="product-subtitle">
                                                        {{ $transaction->user->name }}
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="product-title">Date of Transaction</div>
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
                                                    <div class="product-title">Mobile</div>
                                                    <div class="product-subtitle">
                                                        {{ $transaction->user->phone_number }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endrole

                                <form action="{{ route('transactions.store', ['transaction' => $transaction->code]) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 mt-4">
                                            <h5>Shipping Information</h5>
                                        </div>
                                        <div class="col-12">
                                            <div class="row mt-4">
                                                <div class="col-12 col-md-6">
                                                    <div class="product-title">Address I</div>
                                                    <div class="product-subtitle">
                                                        {{ $transaction->user->address->address_one }}
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="product-title">Address II</div>
                                                    <div class="product-subtitle">
                                                        {{ $transaction->user->address->address_two }}
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="product-title">Province</div>
                                                    <div class="product-subtitle">
                                                        {{ App\Models\Province::find($transaction->user->address->provinces_id)->name }}
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="product-title">City</div>
                                                    <div class="product-subtitle">
                                                        {{ App\Models\Regency::find($transaction->user->address->regencies_id)->name }}
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="product-title">Postal Code</div>
                                                    <div class="product-subtitle">
                                                        {{ $transaction->user->address->zip_code }}
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="product-title">Country</div>
                                                    <div class="product-subtitle">
                                                        {{ $transaction->user->address->country }}
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <div class="product-title">Shipping Status</div>
                                                    @role('seller')
                                                        @if ($transaction->details->first()->product->users_id == Auth::id())
                                                            <select name="shipping_status" id="status"
                                                                class="form-control" v-model="status">
                                                                <option value="PENDING"
                                                                    {{ $transaction->shipping_status == 'PENDING' ? 'selected' : '' }}>
                                                                    Pending
                                                                </option>
                                                                <option value="SHIPPING"
                                                                    {{ $transaction->shipping_status == 'SHIPPING' ? 'selected' : '' }}>
                                                                    Shipping
                                                                </option>
                                                                <option value="SUCCESS"
                                                                    {{ $transaction->shipping_status == 'SUCCESS' ? 'selected' : '' }}>
                                                                    Success
                                                                </option>
                                                            </select>
                                                        @else
                                                            <div class="product-subtitle">
                                                                {{ $transaction->shipping_status }}
                                                            </div>
                                                        @endif
                                                    @else
                                                        <div class="product-subtitle">{{ $transaction->shipping_status }}
                                                        </div>
                                                    @endrole
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <div class="product-title">Resi</div>
                                                    @role('seller')
                                                        @if ($transaction->details->first()->product->users_id == Auth::id())
                                                            <input type="text" class="form-control" name="resi"
                                                                value="{{ $transaction->resi }}">
                                                        @else
                                                            <div class="product-subtitle">{{ $transaction->resi }}</div>
                                                        @endif
                                                    @else
                                                        <div class="product-subtitle">{{ $transaction->resi }}</div>
                                                    @endrole
                                                </div>
                                                <div class="col-12 mt-4">
                                                    @role('seller')
                                                        @if ($transaction->details->first()->product->users_id == Auth::id())
                                                            <button type="submit" class="btn btn-success btn-block">
                                                                Update Shipping
                                                            </button>
                                                        @endif
                                                    @endrole
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                @role('customer')
                                    <div class="row mt-4">
                                        <div class="col-12 text-right">
                                            <h5>
                                                Total Amount: ${{ number_format($transaction->total_price) }}
                                            </h5>
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
</x-app-layout>
