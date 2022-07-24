@extends('layouts.main')
@section('sidebar')
    @include('layouts.merchant_sidebar')
@endsection

@section('content')
    <div class="col-lg-10 col-md-9">
        <div class="container">
            <div class="container-fluid my-5">
                <div class="card">
                    <div class="card-header text-center font-weight-bold text-uppercase py-4">
                        Orders

                        <a href="{{ route('merchant.dashboard', auth()->user()->id) }}" class="float-right">Back</a>

                    </div>
                    <div class="card-body">

                        <div id="dataTable" class="table-editable">
                            <div class="table-responsive">
                                @if (session('status'))
                                    <span>{{ session('status') }}</span>
                                @endif
                                <table class="table table-bordered table-responsive-md table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Payment Status</th>
                                            <th>Ordered At</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($orderItems as $orderItem)
                                            <x-order-item-card :orderitem="$orderItem" />
                                        @empty
                                            <div class="text-center">
                                                <img src="{{ url('images/products', '1655047549matt-logo1.png') }}" />
                                                <h2>No Proucts in Order</h2>
                                            </div>
                                        @endforelse

                                        <!--/Fourth row-->

                                    </tbody>
                                    <!--/Table body-->
                                </table>

                                <div class="d-flex justify-content-between pt-2">
                                    <p class="fw-bold mb-0">Order Details</p>
                                    <p class="text-muted mb-0"><span
                                            class="fw-bold me-4">Total</span>{{ (int) $order->total }}
                                        Products </p>
                                </div>

                                <div class="d-flex justify-content-between pt-2">
                                    <p class="fw-bold mb-0">User Inforamtion</p>
                                    <p class="text-muted mb-0"><span class="fw-bold me-4"> {{ $order->user->id }} </span>
                                </div>
                                <div class="d-flex justify-content-between pt-2">
                                    <p class="text-muted mb-0"><span class="fw-bold me-4">Discount</span> None</p>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <p class="text-muted mb-0">Invoice Date : {{ $order->created_at }}</p>
                                </div>

                                <div class="d-flex justify-content-between mb-5">
                                    <p class="text-muted mb-0"><span class="fw-bold me-4">Delivery Charges</span> Free
                                    </p>
                                </div>
                            </div>
                            <div class="card-footer border-0 px-4 py-5"
                                style="background-color: #a8729a; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                                <h5 class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">
                                    Total
                                    paid: <span
                                        class="h2 mb-0 ms-2">${{ $order->payment()->get('amount')[0]['amount'] }}</span>
                                </h5>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
