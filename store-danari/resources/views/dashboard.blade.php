@section('title', 'Dashboard Store')
<x-app-layout>
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="items-center bg-gradient-to-r from-indigo-200 to-purple-300 px-4 py-2 rounded-md shadow-md">
                <h2 class="text-2xl font-semibold text-indigo-900 leading-tight mb-2">
                    {{ Auth::user()->hasRole('admin') ? __('Admin Dashboard') : (Auth::user()->hasRole('seller') ? __('Seller Dashboard') : __('Customer Dashboard')) }}
                </h2>
                @role('admin')
                    <p class="text-md font-semibold">Look what you have made today!</p>
                @else
                    <p class="text-md font-semibold">Welcome to Dashboard</p>
                @endrole
            </div>
            <div class="dashboard-content mt-4">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="dashboard-card-title">
                                    {{ Auth::user()->hasRole('admin') ? 'Users' : 'Customer' }}</div>
                                <div class="dashboard-card-subtitle">{{ $customerCount }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="dashboard-card-title">Revenue</div>
                                <div class="dashboard-card-subtitle">${{ number_format($revenue) }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="dashboard-card-title">Transactions</div>
                                <div class="dashboard-card-subtitle">{{ $transactions->count() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 mt-2">
                        <h5 class="mb-2">Recent Transactions</h5>
                        @foreach ($recentTransactions as $transaction)
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
                                        <div class="col-md-3">{{ $transaction->created_at->format('d M, Y') }}</div>
                                        <div class="col-md-1 d-none d-md-block">
                                            <img src="{{ asset('images/dashboard-arrow-right.svg') }}"
                                                alt="arrow" />
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                        {{ $recentTransactions->links() }} <!-- Pagination Links -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
