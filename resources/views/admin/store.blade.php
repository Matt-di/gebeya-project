<div class="modal fade" id="addAdminModal" tabindex="-1" role="dialog" aria-labelledby="addAdminModal"
    aria-hidden="true">
    <div class="modal-dialog" role=" document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold" id="titleModal">Add New Admin</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <form action="{{ route('admin.add') }}" method="POST" id="addCategoryForm" name="addCategoryForm">
                    @csrf
                    <div class="form-outline mb-4">
                        <input type="text" id="username" name="username"
                            class="form-control @error('username') is-invalid @enderror"
                            value="{{ old('username') }}" />
                        <label class="form-label" for="username">username</label>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" id="email" name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}" />
                        <label class="form-label" for="email">email</label>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input " type="radio" name="admin_type"
                            id="admin_type" value="client" checked />
                        <label class="form-check-label" for="inlineRadio1">Super Admin</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="admin_type" id="admin_type"
                            value="merchant" />
                        <label class="form-check-label" for="inlineRadio2">Sub Admin</label>

                    </div>
                    <button type="submit" id ="btnSubmitCat"class="btn btn-primary btn-block mb-4">
                        Add
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>