@extends('layouts.main')

@section('sidebar')
    @include('layouts.admin_sidebar');
@endsection

@section('content')
    <div class="container-fluid my-5 py-5">
        <div class="card">

            <h3 class="card-header text-center font-weight-bold text-uppercase py-4">
                Stores
            </h3>
            <div class="card-body">
                <div id="dataTable" class="table-editable">
                    <button class="btn btn-primary table-add float-right mb-3 mr-2" data-mdb-toggle="modal"
                        data-mdb-target="#addCategoryModal">
                        <i class="fas fa-plus mr-5" aria-hidden="true"> Add New</i>
                    </button>
                    <div class="table-responsive">
                        @if (session()->has('success'))
                            <div id="alert_placeholder">
                                <div class="alert alert-success">
                                    {!! \Session::get('success') !!}

                                </div>
                            </div>
                            <script>
                                $(function() {
                                    setTimeout(function() {
                                        if ($(".alert").is(":visible")) {
                                            //you may add animate.css class for fancy fadeout
                                            $(".alert").fadeOut("fast");
                                        }
                                    }, 3000)

                                });
                            </script>
                        @endif
                        @if ($stores->count())
                            <table class="table table-bordered table-responsive-md table-striped text-center">
                                <thead>
                                    <tr>
                                        <th class="text-center">Store ID</th>
                                        <th class="text-center">Categories</th>
                                        <th class="text-center">Products</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Enable</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @props(['category']) --}}
                                    @foreach ($stores as $store)
                                        <tr>
                                            <td class="pt-3-half">
                                                <a href="stores/{{ $store->id }}">{{ $store->firstname }} </a>
                                            </td>
                                            <td class="pt-3-half">{{ $store->categories()->count() }}</td>
                                            <td class="pt-3-half">{{ $store->products()->count() }}</td>
                                            <td class="pt-3-half">
                                                <form action=" {{ route('admin.store.enable', $store->id) }} "
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn  @if ($store->store_status == 1) btn-warning @else btn-success @endif">
                                                        @if ($store->store_status == 1)
                                                            Disable
                                                        @else
                                                            Enable
                                                        @endif
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <span class="  table-remove mb-5">
                                                    <button id="{{ $store->id }}" type="submit"
                                                        class="btn btn-warning btn-rounded btn-sm my-0 edit">
                                                        <i class="fas fa-edit mr-5" aria-hidden="true"> Edit</i>
                                                    </button>
                                                </span>
                                                <span class="table-remove">
                                                    <form action=" {{ route('admin.store.delete', $store->id) }}"
                                                        method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-danger btn-rounded btn-sm my-0">
                                                            <i class="fas fa-trash mr-5" aria-hidden="true"> Remove</i>
                                                        </button>
                                                    </form>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                            </table>
                    </div>
                    {{ $stores->links() }}
                </div>
            </div>
        @else
            <h3 class="card-header text-center font-weight-bold text-uppercase py-4">
                No Categories Created
            </h3>
            @endif
        </div>
    </div>

@endsection

@section('modal')
    @include('admin.store.store')
@endsection
