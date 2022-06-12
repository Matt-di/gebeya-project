@props(['product', 'cart'])

<tr>
    <td>
        <img style="width: 100px; height:100px}}" src="{{ url('images/products', $product->image) }}" alt=""
            class="img-thumbnail">
    </td>
    <td>
        <h5><strong>{{ $product->name }}</strong></h5>
        <p class="text-muted">{{$product->category}}</p>
    </td>
    <td>Blue</td>
    <td>L</td>
    <td>{{ $product->price }}</td>
    <td>
        <span class="qty" id="cartQty">{{ $cart->quantity }}</span>
        <form action="/cart/{{$cart->id}}" method="POST">
            @method("PUT")
            @csrf
            <input min=0 max="{{$product->price}}" required type="number" class="form-input" name="quantity"/>
                <button type="submit" class="btn btn-rounded btn-sm btn-primary btn-rounded">
                    Update
                </button>

        </form>
    </td>
    <td>{{ $product->price * $cart->quantity }}</td>
    <td>
        <form action="{{ route('cart.delete', $cart->id) }}" method="POST">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top"
                title="Remove item">X
            </button>
        </form>
    </td>
</tr>
