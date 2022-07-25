@extends('layouts.main')

@section('sidebar')
    @include('layouts.merchant_sidebar')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">User Information</span>
                        <a class="float-right" href="{{ route('merchant.orders.index', auth()->user()->id) }}">Back</a>
                    </h4>
                </div>
                <ul class="list-group mb-3 sticky-top">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Name</h6>
                            <small class="text-muted"></small>
                        </div>
                        <span class="text-muted">{{ $user->firstname }} {{ $user->lastname }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Email</h6>
                            <small class="text-muted"></small>
                        </div>
                        <span class="text-muted">{{ $user->email }}</span>
                    </li>
                    @if ($user->shippment)
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Phone Numer</h6>
                                <small class="text-muted"></small>
                            </div>
                            <span class="text-muted">{{ $user->userShippment->phone_number }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Country</h6>
                                <small class="text-muted"></small>
                            </div>
                            <span class="text-muted">{{ $user->userShippment->country }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">State</h6>
                                <small class="text-muted"></small>
                            </div>
                            <span class="text-muted">{{ $user->userShippment->state }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">ZipCode</h6>
                                <small class="text-muted"></small>
                            </div>
                            <span class="text-muted">{{ $user->userShippment->zip }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                    @endif

                </ul>
            </div>
        </div>
    </div>
@endsection
