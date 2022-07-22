@extends('layouts.main')

@section('sidebar')
    @include('layouts.admin_sidebar');
@endsection
@section('content')
    <div class="container-fluid my-5 py-5">
        <table class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Type </th>
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
@endsection
