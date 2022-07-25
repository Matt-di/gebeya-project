@extends('layouts.main')

@section('sidebar')
    @include('layouts.admin_sidebar')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
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
@endsection
