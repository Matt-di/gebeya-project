    @props(['product', 'tags'])
    <div class="col mb-5">
        <div class="card h-100">
            <!-- Sale badge-->
            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale
            </div>
            <!-- Product image-->
            <img class="card-img-top" src="{{ url('images/products', $product->image) }}" alt="..." />
            <!-- Product details-->
            <div class="card-body p-4">
                @auth
                    <input type="hidden" id="userId" value="{{ auth()->user()->id }}" />
                @endauth
                <div class="text-center">
                    <!-- Product name-->
                    <div><span>
                            @foreach ($tags as $tag)
                                {{ $tag }}
                            @endforeach
                        </span> </div>
                    <h5 class="fw-bolder"> <a href="{{ route('product.get', $product->id) }}" class="link">
                            {{ $product->name }}
                        </a></h5>
                    <!-- Product price-->
                    <span class="text-muted text-decoration-line-through">${{ $product->price }}</span>
                    ${{ $product->price }}
                </div>
            </div>
            <!-- Product actions-->
            @if ($product->quantity > 0)
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center">
                        <button class="addtocart btn btn-outline-dark mt-auto" id=" id="{{ $product->id }}">Add to
                            cart</button>
                    </div>
                </div>
            @else
                <button type="button" disabled class="btn  flex-fill ms-1">Not Available In Stock</button>
            @endif
        </div>
    </div>
