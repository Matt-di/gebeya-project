@extends('layouts.app')

@section('sidenav')
<div class="col-lg-3">
    @include('layouts.client_sidenav')
</div>
@endsection
@section('content')
<div class="col-lg-6 vstack gap-4 col-md-8">
    <div class="container-fluid my-5 py-5">
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
