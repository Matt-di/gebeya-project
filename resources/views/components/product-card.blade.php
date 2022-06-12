    @props(['product'])
    <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
        <div class="card" style="height: 100%">
            <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light" data-mdb-ripple-color="light">
                <img src="{{ url('images/products', $product->image) }}" alt="Product Image" class="img-thumbnail"
                    />
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
                <a href="{{ route('product.get', $product->id) }}" class="text-reset">
                    <h5 class="card-title mb-3"> {{ $product->name }} </h5>
                </a>
                <a href="" class="text-reset">
                    <p>{{ $product->description }}</p>
                </a>
                <h6 class="mb-3">${{ $product->price }}</h6>

                <div class="d-flex flex-row">
                    @if ($product->quantity > 0)
                        <form method="post" action="{{ route('cart.store', $product->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-primary flex-fill me-1" data-mdb-ripple-color="dark">
                                Add to cart
                            </button>
                        </form>
                        <button type="button" class="btn btn-danger flex-fill ms-1">Buy now</button>
                    @else
                        <button type="button" disabled class="btn  flex-fill ms-1">Not Available In Stock</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
