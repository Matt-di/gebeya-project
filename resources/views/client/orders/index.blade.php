@extends('layouts.main')

@section('sidebar')
    @include('layouts.merchant_sidebar')
@endsection

@section('content')
    <div class="container-fluid">
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
                        @if ($orders->count())
                            <table class="table table-bordered table-responsive-md table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>Order Id</th>
                                        <th>User</th>
                                        <th>Payment Status</th>
                                        <th>Payment Provider</th>
                                        <th>Order Status</th>
                                        <th>Total Order</th>
                                        <th>Total Price</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        @php
                                            $payment = $order->payment;
                                            $user = $order->user;
                                        @endphp
                                        <x-user-order-card :order="$order" :payment="$payment" :user="$user" />
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>No Orders Made Yet.</p>
                        @endif
                    </div>
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
