@section('title', 'Transactions')
<x-app-layout>
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <x-slot name="header">
                <div class="items-center bg-indigo-100 px-6 py-4 rounded-md shadow-md">
                    <h2 class="text-2xl font-semibold text-indigo-900 leading-tight mb-2">Transactions</h2>
                    <p class="text-0xl"> Big result start from the small one</p>
                </div>
            </x-slot>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-12 mt-2">
                        <ul class="nav nav-pills mb-3" id="pills-tab">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-sell-tab" data-bs-toggle="pill" href="#pills-sell"
                                    role="tab" aria-controls="pills-sell" aria-selected="true">Sell Product</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-buy-tab" data-bs-toggle="pill" href="#pills-buy"
                                    role="tab" aria-controls="pills-buy" aria-selected="false">Buy Product</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-sell" role="tabpanel"
                                aria-labelledby="pills-sell-tab">
                                <a href="/dashboard-transactions-details.html" class="card card-list d-block">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <img src="/images/dashboard-icon-product-1.png" alt="icon product" />
                                            </div>
                                            <div class="col-md-4">Shirup Marzzan</div>
                                            <div class="col-md-3">Angga Risky</div>
                                            <div class="col-md-3">12 Januari, 2020</div>
                                            <div class="col-md-1 d-none d-md-block">
                                                <img src="/images/dashboard-arrow-right.svg" alt="arrow" />
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="/dashboard-transactions-details.html" class="card card-list d-block">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <img src="/images/dashboard-icon-product-1.png" alt="icon product" />
                                            </div>
                                            <div class="col-md-4">LeBrone X</div>
                                            <div class="col-md-3">Masayoshi</div>
                                            <div class="col-md-3">11 January, 2020</div>
                                            <div class="col-md-1 d-none d-md-block">
                                                <img src="/images/dashboard-arrow-right.svg" alt="arrow" />
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="/dashboard-transactions-details.html" class="card card-list d-block">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <img src="/images/dashboard-icon-product-1.png" alt="icon product" />
                                            </div>
                                            <div class="col-md-4">Soffa Lembutte</div>
                                            <div class="col-md-3">Shayna</div>
                                            <div class="col-md-3">11 January, 2020</div>
                                            <div class="col-md-1 d-none d-md-block">
                                                <img src="/images/dashboard-arrow-right.svg" alt="arrow" />
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="tab-pane fade" id="pills-buy" role="tabpanel" aria-labelledby="pills-buy-tab">
                                <a href="/dashboard-transactions-details.html" class="card card-list d-block">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <img src="/images/dashboard-icon-product-1.png" alt="icon product" />
                                            </div>
                                            <div class="col-md-4">Shirup Marzzan</div>
                                            <div class="col-md-3">Angga Risky</div>
                                            <div class="col-md-3">12 Januari, 2020</div>
                                            <div class="col-md-1 d-none d-md-block">
                                                <img src="/images/dashboard-arrow-right.svg" alt="arrow" />
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="/dashboard-transactions-details.html" class="card card-list d-block">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <img src="/images/dashboard-icon-product-1.png" alt="icon product" />
                                            </div>
                                            <div class="col-md-4">LeBrone X</div>
                                            <div class="col-md-3">Masayoshi</div>
                                            <div class="col-md-3">11 January, 2020</div>
                                            <div class="col-md-1 d-none d-md-block">
                                                <img src="/images/dashboard-arrow-right.svg" alt="arrow" />
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="/dashboard-transactions-details.html" class="card card-list d-block">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <img src="/images/dashboard-icon-product-1.png" alt="icon product" />
                                            </div>
                                            <div class="col-md-4">Soffa Lembutte</div>
                                            <div class="col-md-3">Shayna</div>
                                            <div class="col-md-3">11 January, 2020</div>
                                            <div class="col-md-1 d-none d-md-block">
                                                <img src="/images/dashboard-arrow-right.svg" alt="arrow" />
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('addon-style')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    @endpush

    @push('addon-script')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
    @endpush

</x-app-layout>
