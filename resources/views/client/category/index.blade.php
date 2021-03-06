@extends('layouts.main')

@section('sidebar')
    @include('layouts.merchant_sidebar')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header text-center">
                <a class="btn btn-primary float-left" href="{{ route('merchant.categories.create', auth()->user()->id) }}">
                    Add New
                </a>

                Your Categories

                <a href="{{ route('merchant.dashboard', auth()->user()->id) }}" class="float-right">Back</a>

            </div>
            <div class="card-body">

                <div id="dataTable" class="table-editable">
                    <div class="table-responsive">
                        @if (session('status'))
                            <span>{{ session('status') }}</span>
                        @endif
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
                            {{ $categories->links() }}
                        @else
                            <h3 class="card-header text-center font-weight-bold text-uppercase py-4">
                                No Categories Created
                            </h3>
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
