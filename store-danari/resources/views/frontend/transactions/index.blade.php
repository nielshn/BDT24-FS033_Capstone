@section('title', 'Transactions Store')
<x-app-layout>
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="items-center bg-gradient-to-r from-indigo-200 to-purple-300 px-4 py-2 rounded-md shadow-md">
                <h2 class="text-2xl font-semibold text-indigo-900 leading-tight mb-2">Transactions</h2>
                <p class="text-md"> Big result start from the small one</p>
            </div>
            <div class="dashboard-content mt-4">
                @if ($role === 'seller')
                    <div class="row">
                        <div class="col-12 mt-2">
                            <ul class="nav nav-pills mb-3" id="pills-tab">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-sell-tab" data-bs-toggle="pill"
                                        href="#pills-sell" role="tab" aria-controls="pills-sell"
                                        aria-selected="true">Sell Product</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-buy-tab" data-bs-toggle="pill" href="#pills-buy"
                                        role="tab" aria-controls="pills-buy" aria-selected="false">Buy Product</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-sell" role="tabpanel"
                                    aria-labelledby="pills-sell-tab">
                                    @foreach ($sellTransactions as $transaction)
                                        <a href="{{ route('transactions.show', ['transaction' => $transaction->transaction->code]) }}"
                                            class="card card-list d-block">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        <img src="{{ Storage::url($transaction->product->productGaleries->first()->photos ?? 'images/no-image.png') }}"
                                                            alt="{{ $transaction->product->name }}" />
                                                    </div>
                                                    <div class="col-md-4">{{ $transaction->product->name }}</div>
                                                    <div class="col-md-3">{{ $transaction->transaction->user->name }}
                                                    </div>
                                                    <div class="col-md-3">
                                                        {{ $transaction->created_at->format('d M, Y') }}</div>
                                                    <div class="col-md-1 d-none d-md-block">
                                                        <img src="{{ asset('images/dashboard-arrow-right.svg') }}"
                                                            alt="arrow" />
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                    {{ $sellTransactions->links() }} <!-- Pagination Links -->
                                </div>
                                <div class="tab-pane fade" id="pills-buy" role="tabpanel"
                                    aria-labelledby="pills-buy-tab">
                                    @foreach ($buyTransactions as $transaction)
                                        <a href="{{ route('transactions.show', ['transaction' => $transaction->transaction->code]) }}"
                                            class="card card-list d-block">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        <img src="{{ Storage::url($transaction->product->productGaleries->first()->photos ?? 'images/no-image.png') }}"
                                                            alt="{{ $transaction->product->name }}" />
                                                    </div>
                                                    <div class="col-md-4">{{ $transaction->product->name }}</div>
                                                    <div class="col-md-3">{{ $transaction->transaction->user->name }}
                                                    </div>
                                                    <div class="col-md-3">
                                                        {{ $transaction->created_at->format('d M, Y') }}</div>
                                                    <div class="col-md-1 d-none d-md-block">
                                                        <img src="{{ asset('images/dashboard-arrow-right.svg') }}"
                                                            alt="arrow" />
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                    {{ $buyTransactions->links() }} <!-- Pagination Links -->
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row mt-3">
                        <div class="col-12 mt-2">
                            <h5 class="mb-2">Recent Transactions</h5>
                            @foreach ($transactions as $transaction)
                                <a href="{{ route('transactions.show', ['transaction' => $transaction->transaction->code]) }}"
                                    class="card card-list d-block">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <img src="{{ Storage::url($transaction->product->productGaleries->first()->photos ?? 'images/no-image.png') }}"
                                                    alt="{{ $transaction->product->name }}" />
                                            </div>
                                            <div class="col-md-4">{{ $transaction->product->name }}</div>
                                            <div class="col-md-3">{{ $transaction->transaction->user->name }}</div>
                                            <div class="col-md-3">{{ $transaction->created_at->format('d M, Y') }}
                                            </div>
                                            <div class="col-md-1 d-none d-md-block">
                                                <img src="{{ asset('images/dashboard-arrow-right.svg') }}"
                                                    alt="arrow" />
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                            {{ $transactions->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- @push('addon-style')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
            integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    @endpush --}}

    @push('addon-script')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>
    @endpush

</x-app-layout>
