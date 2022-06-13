@extends('layouts.app')

@section('content')
    <div class="container-fluid my-5 py-5">
        <div class="row">

            @foreach ($dashboard_data as $data)
                <x-admin-dashboard-card :data="$data" />
            @endforeach

        </div>
        <!-- Grid row -->

       <!-- Section: Block Content -->

    </div>
@endsection

@section('modal')
    @include('admin.store')
@endsection
