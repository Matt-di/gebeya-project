@extends('layouts.main')

@section('sidebar')
    @include('layouts.admin_sidebar');
@endsection

@section('content')
    <div class="container-fluid my-5 py-5">
        <div class="card">

            <div class="card-header text-center text-uppercase ">
                <h3>
                    Stores
                </h3>

            </div>
            <div class="card-body">
                <div id="dataTable" class="table-editable">

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
                                        <th class="text-center">Store</th>
                                        <th class="text-center">Categories</th>
                                        <th class="text-center">Products</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="4">

                                        </td>
                                        <td>
                                            <p class="text-muted">
                                                Please be aware that Wiping and removing will permanently remove user data.
                                            </p>
                                        </td>
                                    </tr>
                                    {{-- @props(['category']) --}}
                                    @foreach ($stores as $store)
                                        <tr>
                                            <td class="pt-3-half">
                                                <a href="{{ route('admin.stores.show', $store->id) }}">{{ $store->firstname }}
                                                </a>
                                            </td>
                                            <td class="pt-3-half">{{ $store->categories()->count() }}</td>
                                            <td class="pt-3-half">{{ $store->products()->count() }}</td>
                                            <td class="pt-3-half">

                                                <span
                                                    class="py-2 alert  @if ($store->store_status == 1) alert-success @else alert-warning @endif">
                                                    @if ($store->store_status == 1)
                                                        Active
                                                    @else
                                                        Disabled
                                                    @endif
                                                </span>
                                                </form>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Second group">

                                                    <div>
                                                        <a href="{{ route('admin.stores.edit', $store->id) }}"
                                                            class="btn btn-warning btn-rounded btn-sm m-2">
                                                            <i class="fas fa-edit mr-2" aria-hidden="true"> </i>Edit
                                                        </a>
                                                    </div>
                                                    <div>

                                                        <form action=" {{ route('admin.stores.destroy', $store->id) }}"
                                                            method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-danger btn-rounded btn-sm m-2">
                                                                <i class="fas fa-trash mr-2" aria-hidden="true"> </i>Remove
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div>

                                                        <form action=" {{ route('admin.stores.wipe', $store->id) }}"
                                                            method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-danger btn-rounded btn-sm m-2">
                                                                <i class="fas fa-trash mr-2" aria-hidden="true"> </i>Wipe
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div>
                                                        <form action=" {{ route('admin.store.enable', $store->id) }} "
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-rounded btn-sm m-2  @if ($store->store_status == 1) btn-warning @else btn-success @endif">
                                                                @if ($store->store_status == 1)
                                                                    Disable
                                                                @else
                                                                    Enable
                                                                @endif
                                                            </button>
                                                        </form>
                                                    </div>

                                                    @canImpersonate
                                                    <div>

                                                        <a href="{{ route('admin.users.impersonate', $store->id) }}"
                                                            class="btn btn-primary btn-rounded btn-sm m-2">
                                                            <i class="fas fa-login mr-2" aria-hidden="true"></i>Impersonate
                                                        </a>
                                                    </div>
                                                    @endCanImpersonate
                                                </div>
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
                No Stores Found
            </h3>
            @endif
        </div>
    </div>

@endsection
