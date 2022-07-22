@extends('layouts.main')

@section('sidebar')
    @include('layouts.merchant_sidebar')
@endsection
@section('content')
<div class="col-lg-10 col-md-9">
    <div class="container">
        <div class="container-fluid my-5">
                <div class="card">
                    <h3 class="card-header text-center weight-bold py-4">
                        @if ($title ?? '')
                            {{ $title ?? ('' ?? '') }}
                        @else
                            Your Products
                        @endif
                        <a href="{{route('merchant.categories.index',auth()->user()->id)}}" class="float-right">Back</a>

                    </h3>
                    <div class="card-body">
                        <div id="dataTable" class="table-editable">
                                 @if ($products->count()> 0)
                                <table class="table table-bordered table-responsive-md table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Product</th>
                                            <th class="text-center">Name</th>
                                            @if (!$title)
                                                <th class="text-center">Category</th>
                                            @endif
                                            <th class="text-center">Description</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            @if (!$title)
                                                {{ $name = $categories->find($product->category_id)->name }}
                                            @else
                                                {{ $name = 'none' }}
                                            @endif
                                            <x-product-list :product="$product" :name="$name" />
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
                    {{ $products->links() }}
                </div>
        </div>
    </div>
    </div>
@endsection
@section('modal')
    @include('client.product.store')
@endsection
