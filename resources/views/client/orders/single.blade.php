@extends('layouts.app')

@section('sidenav')
    <div class="col-lg-4 col-md-4">
        @include('layouts.client_sidenav')
    </div>
@endsection
@section('content')
<div class="col-lg-8 col-md-8">
<section class="h-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-10 col-xl-8">
          <div class="card" style="border-radius: 10px;">
            <div class="card-body p-4">
              <div class="d-flex justify-content-between align-items-center mb-4">
                <p class="lead fw-normal mb-0" style="color: #a8729a;">Orders</p>
              </div>
              @foreach ($orders as $order)
                  <x-order-card />
              @endforeach

  
              <div class="d-flex justify-content-between pt-2">
                <p class="fw-bold mb-0">Order Details</p>
                <p class="text-muted mb-0"><span class="fw-bold me-4">Total</span> $898.00</p>
              </div>
  
              <div class="d-flex justify-content-between pt-2">
                <p class="text-muted mb-0">Invoice Number : 788152</p>
                <p class="text-muted mb-0"><span class="fw-bold me-4">Discount</span> $19.00</p>
              </div>
  
              <div class="d-flex justify-content-between">
                <p class="text-muted mb-0">Invoice Date : 22 Dec,2019</p>
                <p class="text-muted mb-0"><span class="fw-bold me-4">GST 18%</span> 123</p>
              </div>
  
              <div class="d-flex justify-content-between mb-5">
                <p class="text-muted mb-0">Recepits Voucher : 18KU-62IIK</p>
                <p class="text-muted mb-0"><span class="fw-bold me-4">Delivery Charges</span> Free</p>
              </div>
            </div>
            <div class="card-footer border-0 px-4 py-5"
              style="background-color: #a8729a; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
              <h5 class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">Total
                paid: <span class="h2 mb-0 ms-2">$1040</span></h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
