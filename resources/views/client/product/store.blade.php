<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg"" role=" document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Add New Product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <form action="{{ route('products.add') }}" action="POST" id="addProductForm" name="addProductForm">
                    @csrf
                    <div class="form-outline mb-4">
                        <input type="text" id="product_name" name="product_name"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('product_name') }}" />
                        <label class="form-label" for="product_name">Product Name</label>
                        @error('product_name')
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
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="email" id="category" name="category"
                            class="form-control @error('category') is-invalid @enderror"
                            value="{{ old('category') }}" />
                        <label class="form-label" for="category">Category</label>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input type="text" id="price" name="price"
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
                        <input type="file" min=0 id="image" name="image"
                            class="form-control @error('email') is-invalid @enderror" value="{{ old('image') }}" />
                        <label class="form-label" for="image">Product Image</label>
                        @error('quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mb-4">
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
