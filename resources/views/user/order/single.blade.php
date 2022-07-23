@extends('layouts.app')

@section('content')
    <section class="h-100 gradient-custom">
        <div class="container py-5 h-100">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/"><i class="fa fa-dashboard "></i>Home</a>
                    </li>
                    <?php $segments = ''; ?>
                    @foreach (Request::segments() as $segment)
                        <?php $segments .= '/' . $segment; ?>
                        <li class="breadcrumb-item active">
                            <a href="{{ $segments }}">{{ $segment }}</a>
                        </li>
                    @endforeach
                </ol>
            </nav>
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-10 col-xl-8">
                    <div class="card" style="border-radius: 10px;">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <p class="lead fw-normal mb-0" style="color: #a8729a;">Orders</p>
                            </div>
                            <table class="table product-table">
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
                                <p class="text-muted mb-0"><span class="fw-bold me-4">Total</span>{{ (int) $order->total }}
                                    Products </p>
                            </div>

                            <div class="d-flex justify-content-between pt-2">
                                <p class="text-muted mb-0"><span class="fw-bold me-4">Discount</span> None</p>
                            </div>

                            <div class="d-flex justify-content-between">
                                <p class="text-muted mb-0">Invoice Date : {{ $order->created_at }}</p>
                            </div>

                            <div class="d-flex justify-content-between mb-5">
                                <p class="text-muted mb-0"><span class="fw-bold me-4">Delivery Charges</span> Free</p>
                            </div>
                        </div>
                        <div class="card-footer border-0 px-4 py-5"
                            style="background-color: #a8729a; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                            <h5 class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">
                                Total
                                paid: <span class="h2 mb-0 ms-2">${{ $order->payment()->get('amount')[0]['amount'] }}</span>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
