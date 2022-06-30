@extends('layouts.app')

@section('content')
    <div class="row g-4">
        <div class="col-lg-2 col-md-2 my-5">
            @yield('sidenav')
        </div>
        <div class="col-lg-10 col-md-9">
            @yield('content')
        </div>
    </div>
@endsection
