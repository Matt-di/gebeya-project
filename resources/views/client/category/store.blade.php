<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addcategoryModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg"" role=" document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold" id="titleModal">Add New Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <form action="{{ route('category.add') }}" method="POST" id="addCategoryForm" name="addCategoryForm">
                    @csrf
                    <div class="form-outline mb-4">
                        <input type="text" id="name" name="name"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('name') }}" />
                        <label class="form-label" for="name">Category Name</label>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-outline mb-4">
                        <input type="text" id="description" name="description"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('description') }}" />
                        <label class="form-label" for="description">Category Description</label>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input class="form-check-input  @error('show_nav') is-invalid @enderror" type="checkbox" 
                        id="show_nav" value="0" name="show_nav"/>
                        <label class="form-label" for="show_nav">Show In Navbar</label>
                        @error('show_nav')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" id ="btnSubmitCat"class="btn btn-primary btn-block mb-4">
                        Add
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- <script>
    $(function() {
        $("#addCatgoryForm").on("submit", function(event) {
            event.preventDefault();
            console.log('hello');
            var formData = $(this).serialize();
            console.log(formData);

            $.ajax({
                url: "/categorys",
                type: "post",
                data: formData,
                success: function(d) {
                    alert(d);
                }
            });
        });
    })
</script> --}}
