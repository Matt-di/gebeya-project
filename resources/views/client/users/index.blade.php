@extends('layouts.app')

@section('sidenav')
    <div class="row g-4">
        <div class="col-lg-2 col-md-2 my-5">
            @include('layouts.client_sidenav')
        </div>
        <div class="col-lg-10 col-md-9">
            <div class="container-fluid my-5 py-5">
                <table class="table align-middle mb-0 bg-white">
                    <thead class="bg-light">
                        <tr>
                            <th>Id</th>
                            <th>Email</th>
                            <th>Total Orders</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>


                        @foreach ($users as $user)
                            <x-user-card :user="$user" :orders="$user->orders" />
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
