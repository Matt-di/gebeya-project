@extends('layouts.main')

@section('sidebar')
    @include('layouts.merchant_sidebar')
@endsection

@section('content')
    <div class="col-lg-10 vstack gap-4 col-md-9">
        <div class="container-fluid">
            <section>
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
