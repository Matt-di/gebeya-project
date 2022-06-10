@extends('layouts.app')

@section('content')
    <section class="" style="background-color: #eee;">
        <h3 class="justify-content-center">My Orders</h3>
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                @for ($i = 0; $i < 7; $i++)
                    <x-order-card />
                @endfor
            </div>
        </div>
    </section>
@endsection

