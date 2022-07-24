@extends('layouts.main')

@section('sidebar')
    @include('layouts.admin_sidebar')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Store Detail') }}
                        <a href="{{ route('admin.stores.index', $store->id) }}" class="float-right">Back</a>
                    </div>

                    <div class="card-body">
                        {{$store->firstname}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
