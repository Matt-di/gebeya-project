@extends('layouts.client_app')

@section('sidenav')
<div class="col-lg-2 col-md-2 my-5">
    @include('layouts.client_sidenav')
</div>
@endsection
@section('content')
<div class="col-lg-10 vstack gap-4 col-md-9">
    <div class="container-fluid">
        <section>
            <style>
                .footer-hover {
                    background-color: rgba(0, 0, 0, 0.1);
                    -webkit-transition: all .3s ease-in-out;
                    transition: all .3s ease-in-out
                }

                .footer-hover:hover {
                    background-color: rgba(0, 0, 0, 0.2)
                }

                .text-black-40 {
                    color: rgba(0, 0, 0, 0.4)
                }
            </style>
            <div class="row">
                @foreach ($dashboard_data as $data)
                <x-dashboard-card :data="$data" />
                @endforeach
            </div>

        </section>
        <!-- Section: Block Content -->

    </div>
</div>
@endsection
