@extends('layouts.app')


@section('content')
    <div class="container-fluid my-5 py-5">
        <div class="card">
            <h3 class="card-header text-center font-weight-bold text-uppercase py-4">
                All Products
            </h3>
            <div class="card-body">
                <div id="dataTable" class="table">
                    <button type="button" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#confirmModal">
                        Delete All
                    </button>
                    @if ($products->count())
                        <table class="table table-bordered table-responsive-md table-striped text-center">
                            <thead>
                                <tr>
                                    <th class="text-center">Product</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Category</th>
                                    <th class="text-center">Created By</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <x-product-list :product="$product" :user="$product->user->firstname" :name="$product->categories" />
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
@endsection
@section('modal')
    @include('admin.store.delete')
@endsection
