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
                        @if ($title ?? '')
                            {{ $title ?? ('' ?? '') }}
                        @else
                            Your Categories
                        @endif
                    </h3>
                    <div class="card-body">
                        <div id="dataTable" class="table-editable">
                            <button class="btn btn-primary table-add float-right mb-3 mr-2" data-mdb-toggle="modal"
                                data-mdb-target="#addCategoryModal">
                                <i class="fas fa-plus mr-5" aria-hidden="true"> Add New</i>
                            </button>
                            @if ($categories->count())
                                <table class="table table-bordered table-responsive-md table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Category</th>
                                            <th class="text-center">Description</th>
                                            <th class="text-center">Show In Navbar</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <x-category-list :category="$category" />
                                        @endforeach
                                    </tbody>
                                </table>
                        </div>
                        {{ $categories->links() }}
                    </div>
                @else
                    <h3 class="card-header text-center font-weight-bold text-uppercase py-4">
                        No Categories Created
                    </h3>
                    @endif
                </div>
            </section>
            <!-- Section: Block Content -->

        </div>
    </div>
@endsection
@section('modal')
    @include('client.category.store')
@endsection
