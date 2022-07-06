<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addcategoryModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg"" role=" document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold" id="titleModal">Add New Store</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <form action="{{route('admin.store.add')}}" method="POST" id="addstore" name="addstore">
                    @csrf
                    <div class="form-outline mb-4">
                        <input type="text" id="firstname" name="firstname"
                            class="form-control @error('firstname') is-invalid @enderror"
                            value="{{ old('firstname') }}" />
                        <label class="form-label" for="firstname">Client Name</label>
                        @error('firstname')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-outline mb-4">
                        <input class="form-control  @error('email') is-invalid @enderror" type="email" id="email"
                            name="email" />
                        <label class="form-label" for="email">Email</label>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-outline mb-4">
                        <input class="form-control  @error('email') is-invalid @enderror" type="password" id="password"
                            name="password" />
                        <label class="form-label" for="password">Password</label>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" id="btnSubmitStore" class="btn btn-primary btn-block mb-4">
                        Add
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
