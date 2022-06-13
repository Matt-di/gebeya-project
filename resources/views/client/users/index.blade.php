@extends('layouts.app')

@section('sidenav')
    <div class="col-lg-2 col-md-2">
        @include('layouts.client_sidenav')
    </div>
@endsection
@section('content')
    <div class="col-lg-8 col-md-8">
        <div class="container">
            <div class="container-fluid my-5 py-5">
                <table class="table align-middle mb-0 bg-white">
                    <thead class="bg-light">
                        <tr>
                            <th>Id</th>
                            <th>Email</th>
                            <th>Total Orders</th>
                            <th>Total Payed</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        
                            @foreach ($users as $user)
                                <x-user-card :user="$user" :orders="$user->orders" :orderItems="$user->orderItems" />
                            @endforeach
                     
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
