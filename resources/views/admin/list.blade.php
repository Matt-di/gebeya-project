@extends('layouts.main')

@section('sidebar')
    @include('layouts.admin_sidebar');
@endsection

@section('content')
    <div class="container-fluid my-5 py-5">
        <button class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#addAdminModal">
            <i class="fas fa-plus mr-5" aria-hidden="true"> Add Admin</i>
        </button>
        @if (session()->has('success'))
            <div id="alert_placeholder">
                <div class="alert alert-success">
                    {!! \Session::get('success') !!}

                </div>
            </div>
            <script>
                $(function() {
                    setTimeout(function() {
                        if ($(".alert").is(":visible")) {
                            //you may add animate.css class for fancy fadeout
                            $(".alert").fadeOut("fast");
                        }
                    }, 3000)

                });
            </script>
        @endif
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
                    <x-admin-user-card :user="$user" />
                @endforeach

            </tbody>
        </table>
        {{ $users->links() }}

    </div>
@endsection
@include('admin.store')
