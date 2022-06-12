@extends('layouts.app')


@section('sidenav')
<div class="col-lg-2 col-md-4">
    @include('layouts.client_sidenav')
</div>
@endsection
@section('content')
<div class="col-lg-8 col-md-8">
    <div class="container">
        <div class="container-fluid my-5 py-5">
            <section>
                <div class="card">
                    <h3 class="card-header text-center font-weight-bold text-uppercase py-4">
                        @if ($title ?? '')
                            {{ $title ?? ('' ?? '') }}
                        @else
                            Your Products
                        @endif
                    </h3>
                    <div class="card-body">
                        <div id="dataTable" class="table-editable">
                            <button class="btn btn-primary table-add float-right mb-3 mr-2" data-mdb-toggle="modal"
                                data-mdb-target="#addProductModal">
                                <i class="fas fa-plus mr-5" aria-hidden="true"> Add New</i>
                            </button>
                            @if ($products->count())
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
                <!-- Editable table -->
                <!-- Grid row -->

            </section>
            <!-- Section: Block Content -->

        </div>
    </div>
    </div>
@endsection
@section('modal')
    @include('client.product.store')
@endsection
