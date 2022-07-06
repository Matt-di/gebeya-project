    @props(['product', 'tags'])
    <div class="col-lg-4 col-md-6 col-sm-6 mb-4" style="height: 400px">
        <div class="card" style="height: 100%">
            <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light" data-mdb-ripple-color="light">
                <img style="" src="{{ url('images/products', $product->image) }}" alt="Product Image"
                    class="img-thumbnail" />
                <a href="#!">
                    <div class="mask">
                        <div class="d-flex justify-content-start align-items-end h-100">
                            <h5><span class="badge bg-primary ms-2">New</span></h5>
                        </div>
                    </div>
                    <div class="hover-overlay">
                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                    </div>
                </a>
            </div>
            <div class="card-body">
                <div><span>
                        @foreach ($tags as $tag)
                            {{ $tag }}
                        @endforeach
                    </span> </div>
                <a href="{{ route('product.get', $product->id) }}" class="link">
                    <h5 class="card-title mb-3"> {{ $product->name }} </h5>
                </a>
                <p href="" class="text-reset">
                <p>{{ Str::substr($product->description, 0, 40) }}..<a href="#" class="link">More</a></p>
                </p>
                <h6 class="mb-3">${{ $product->price }}</h6>

                <div class="d-flex flex-row">
                    @auth
                    <input type="hidden" id="userId" value="{{ auth()->user()->id }}" />
                    @endauth
                    @if ($product->quantity > 0)
                        <button type="submit" class="btn btn-primary flex-fill me-1 addtocart"
                            id="{{ $product->id }}" data-mdb-ripple-color="dark">
                            Add to cart
                        </button>
                        <button type="button" class="btn btn-danger flex-fill ms-1">Buy now</button>
                    @else
                        <button type="button" disabled class="btn  flex-fill ms-1">Not Available In Stock</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
