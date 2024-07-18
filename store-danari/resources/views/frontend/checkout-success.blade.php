@extends('layouts.success')

@section('title')
    Success Page - DANARI STORE
@endsection

@section('content')
    <div class="page-content page-success">
        <div class="section-success" data-aos="zoom-in">
            <div class="container">
                <div class="row align-items-center row-login justify-content-center">
                    <div class="col-lg-6 text-center">
                        <img src="/images/success.svg" alt="success" class="mb-4" />
                        <h2>Transaction Processed</h2>
                        <p>
                            Silahkan tunggu konfirmasi email dari kami dan kami akan
                            menginformasikan resi secepat mungkin!
                        </p>
                        <div>
                            <button id="pay-button" class="btn btn-success w-50 mt-4">Pay Now</button>
                            <a href="{{ route('dashboard') }}" class="btn btn-signup w-50 mt-2">My Dashboard</a>
                            <a href="{{ route('front.home') }}" class="btn btn-signup w-50 mt-2">Go To Shopping</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    alert("Payment success!");
                    console.log(result);
                    // Redirect to success page or other action
                },
                onPending: function(result) {
                    alert("Waiting for your payment!");
                    console.log(result);
                },
                onError: function(result) {
                    alert("Payment failed!");
                    console.log(result);
                },
                onClose: function() {
                    alert('You closed the popup without finishing the payment');
                }
            });
        };
    </script>
@endpush
