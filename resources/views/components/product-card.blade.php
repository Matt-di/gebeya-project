    @props(['product', 'tags'])
    <div class="col mb-5">
        <div class="card h-100">
            <!-- Sale badge-->
            @foreach ($tags as $tag)
                <span class="badge bg-dark text-white position-absolute"
                    style="top: 0.5rem; right: 0.5rem">{{ $tag }}</span>
            @endforeach
            <!-- Product image-->
            <img class="portrait" src="{{ url('images/products', $product->image) }}" alt="..." />
            <!-- Product details-->
            <div class="card-body p-4">
                <div class="text-center">
                    <!-- Product name-->
                    <div><span>
                            @foreach ($tags as $tag)
                                {{ $tag }}
                            @endforeach
                        </span> </div>
                    <h5 class="fw-bolder"> <a href="{{ route('product.get', ['id'=>$product->user->id,'product'=>$product->id]) }}" class="link">
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
            
                        <div class="btn-group" role="group">
                            <input class="form-input m-2" type="number" value="1" min="1" max="100">
                            <button type="button" class="add-to-cart btn btn-sm m-2 btn-primary"
                                data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                data-price="{{ $product->price }}">Add to Cart</button>
                        </div>
     
                    </div>
                </div>
            @else
                <button type="button" disabled class="btn  flex-fill ms-1">Not Available In Stock</button>
            @endif
        </div>
    </div>
