@extends('layouts.app')

@section('content')
    <section style="background-color: #eee;">
        <div class="text-center container py-5">
            
            <div class="row">
                <h3>Latest Products</h3>
                @for ($i = 0; $i < 10; $i++)
                    <x-product-card />
                @endfor
            </div>

        </div>
    </section>
@endsection
