<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg"" role=" document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Add New Product</h4>
                <button type="button" class="close" data-dismiss="modal" id="closeProductModal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <form enctype="multipart/form-data" action="{{ route('store.products',auth()->user()->id) }}" method="POST"
                    id="addProductForm" name="addProductForm">
                    @csrf
                    <div class="form-outline mb-4">
                        <input type="text" id="name" name="name"
                            class="form-control @error('email') is-invalid @enderror" value="{{ old('name') }}" />
                        <label class="form-label" for="name">Product Name</label>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" id="description" name="description"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('description') }}" />
                        <label class="form-label" for="description">Product Description</label>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-outline mb-4">
                        <input type="number" id="price" name="price"
                            class="form-control @error('email') is-invalid @enderror" value="{{ old('price') }}" />
                        <label class="form-label" for="price">Price</label>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-outline mb-4">
                        <input type="number" min=0 id="quantity" name="quantity"
                            class="form-control @error('email') is-invalid @enderror" value="{{ old('quantity') }}" />
                        <label class="form-label" for="quantity">Quantity</label>
                        @error('quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-outline mb-4">
                        <label class="form-label ml-2 p-2" for="image">Product Image</label>

                        <input accept="image/png, image/jpeg" type="file" min=0 id="image" name="image"
                            class="form-control @error('email') is-invalid @enderror" value="{{ old('image') }}" />
                        @error('quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" id="tags" name="tags" placeholder="comma separated tags"
                            class="form-control @error('tags') is-invalid @enderror"
                            value="{{ old('tags') }}" />
                        <label class="form-label" for="description">Product Tags</label>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class=" mb-4">
                        <select class="select" multiple name="category[]" id="category">
                            <option>Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button id="btnSubmitProduct" type="submit" class="btn btn-primary btn-block mb-4">
                        Add
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- <script>
    $(function() {
        $("#addProductForm").on("submit", function(event) {
            event.preventDefault();
            console.log('hello');
            var formData = $(this).serialize();
            console.log(formData);

            $.ajax({
                url: "/products",
                type: "post",
                data: formData,
                success: function(d) {
                    alert(d);
                }
            });
        });
    })
</script> --}}
