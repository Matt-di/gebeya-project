@extends('layouts.app')


@section('content')
    <div class="container-fluid my-5 py-5">
        <table class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Admin Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>


                @foreach ($users as $user)
                    <x-admin-user-card :user="$user"  />
                @endforeach

            </tbody>
        </table>

    </div>
@endsection
