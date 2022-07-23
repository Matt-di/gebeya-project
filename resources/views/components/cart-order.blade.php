@props(['product', 'cart'])

<tr>
    <td>
        <img style="width: 100px; height:100px}}" src="{{ url('images/products', $product->image) }}" alt=""
            class="img-thumbnail">
    </td>
    <td>
        <h5><strong>{{ $product->name }}</strong></h5>
        <p class="text-muted">{{ $product->category }}</p>
    </td>
    <td>Blue</td>
    <td>L</td>
    <td id="priceProduct">{{ $product->price }}</td>
    <td>
        @auth
            <input type="hidden" id="userId" value="{{ auth()->user()->id }}" />
        @endauth

        <form action="{{ route('user.carts.update', ['user' => auth()->user()->id, 'cart' => $cart->id]) }}"
            method="post">
            @csrf
            @method('PUT')
            <input class="form-input" min=0 value="{{ $cart->quantity }}" max="{{ $product->price }}" required
                type="number" class="form-input" id="quantityUpdate" name="quantity" />
            <button type="submit" class="btn btn-rounded btn-sm btn-success btn-rounded updateQuantity">
                Update
            </button>
        </form>


    </td>
    <td id="totalPrice">{{ $product->price * $cart->quantity }}</td>
    <td>

        <form action="{{ route('user.carts.destroy', ['user' => auth()->user()->id, 'cart' => $cart->id]) }}"
            method="POST">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top"
                title="Remove item">X
            </button>
        </form>
    </td>
</tr>
