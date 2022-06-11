@extends('layouts.app')


@section('sidenav')
    @include('layouts.client_sidenav')
@endsection
@section('content')
    <div class="container">
        <div class="container-fluid my-5 py-5">

            <!-- Section: Block Content -->
            <section>

                <div class="card">
                    <h3 class="card-header text-center font-weight-bold text-uppercase py-4">
                        Your Products
                    </h3>
                    <div class="card-body">
                        <div id="dataTable" class="table-editable">
                            <button class="btn btn-primary table-add float-right mb-3 mr-2" data-mdb-toggle="modal"
                                data-mdb-target="#addProductModal">
                                <i class="fas fa-plus mr-5" aria-hidden="true"> Add New</i>
                            </button>
                            <table class="table table-bordered table-responsive-md table-striped text-center">
                                <thead>
                                    <tr>
                                        <th class="text-center">Product Id</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Category</th>
                                        <th class="text-center">Description</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-center">Sort</th>
                                        <th class="text-center">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < 5; $i++)
                                        <x-product-list />
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Editable table -->
                <!-- Grid row -->

            </section>
            <!-- Section: Block Content -->

        </div>
    </div>
@endsection
@include('client.product.store')
