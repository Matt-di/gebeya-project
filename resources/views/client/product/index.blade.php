@extends('layouts.main')

@section('sidebar')
    @include('layouts.merchant_sidebar')
@endsection

@section('content')
    <div class="col-lg-10 col-md-9">
        <div class="container">
            <div class="container-fluid my-5">
                <div class="card">
                    <div class="card-header text-center font-weight-bold text-uppercase py-4">
                        Your Products
                        <a href="{{route('merchant.dashboard',auth()->user()->id)}}" class="float-right">Back</a>
                    </div>
                    <div class="card-body">
                        <div id="dataTable" class="table-editable">
                            <a type="button" class="btn btn-primary mb-2"
                                href="{{ route('merchant.products.create', auth()->user()->id) }}">
                                Add New
                            </a>
                            <div class="table-responsive">
                                @if (session('status'))
                                    <span>{{ session('status') }}</span>
                                @endif
                                @if ($products->count())
                                    <table class="table table-bordered table-responsive-md table-striped text-center">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Product</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Category</th>
                                                <th class="text-center">Tags</th>
                                                <th class="text-center">Description</th>
                                                <th class="text-center">Price</th>
                                                <th class="text-center">Qty</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $product)
                                                <x-product-list :product="$product" :name="$product->categories" />
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <h3 class="text-center font-weight-bold text-uppercase py-4">
                                        No Products Found..
                                    </h3>
                                @endif
                            </div>
                        </div>

                    </div>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
