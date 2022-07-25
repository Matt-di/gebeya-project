@extends('layouts.main')
@section('sidebar')
    @include('layouts.merchant_sidebar')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
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
                      
                                </div>

                                <div class="d-flex justify-content-between pt-2">
                                    <p class="text-muted mb-0"><span class="fw-bold me-4">Discount</span> None</p>
                                </div>

                                <div class="d-flex justify-content-between pt-2">
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
            <div class="col-md-4 my-2">
                <div class="card">
                    <div class="card-header">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">User Information</span>
                        </h4>
                    </div>
                    <ul class="list-group mb-3 sticky-top">
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Name</h6>
                                <small class="text-muted"></small>
                            </div>
                            <span class="text-muted">{{ $order->user->fistname }} {{ $order->user->lastname }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Country</h6>
                                <small class="text-muted"></small>
                            </div>
                            <span class="text-muted">{{ $order->user->userShippment->country }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">State</h6>
                                <small class="text-muted"></small>
                            </div>
                            <span class="text-muted">{{ $order->user->userShippment->state }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">ZipCode</h6>
                                <small class="text-muted"></small>
                            </div>
                            <span class="text-muted">{{ $order->user->userShippment->zip }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total {{ (int) $order->total }} Product</span>
                            <strong></strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
