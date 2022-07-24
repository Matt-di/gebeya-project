@extends('layouts.main')

@section('sidebar')
    @include('layouts.admin_sidebar')
@endsection

@section('content')
    <div class="container-fluid my-5">
        <div class="card">
            <div class="card-header text-center font-weight-bold text-uppercase py-4">
                
                <a class="btn btn-primary float-left" href="{{ route('admin.users.create') }}">
                    Add New
                </a>
                Users

                <a href="{{ route('merchant.dashboard', auth()->user()->id) }}" class="float-right">Back</a>

            </div>
            <div class="card-body">
                <div id="dataTable" class="table-editable">
                    <div class="table-responsive">
                        @if (session('status'))
                            <span>{{ session('status') }}</span>
                        @endif
                        @if ($users->count())
                            <table class="table table-bordered table-responsive-md table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Email</th>
                                        <th>Total Orders</th>
                                        <th>Type</th>
                                        <th>Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td >
                                            <p class="text-muted">Note Removing users will also remove their stores</p>

                                        </td>
                                    </tr>

                                    @foreach ($users as $user)
                                        <x-user-card :user="$user" :orders="$user->orders" />
                                    @endforeach

                                </tbody>
                            </table>
                        @else
                            <p>No Registered Customers </p>
                        @endif
                    </div>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
