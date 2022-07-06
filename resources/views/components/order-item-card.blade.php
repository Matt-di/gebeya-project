@props(['orderitem'])

<?php $product = \App\Models\Product::where('id', $orderitem->product_id)->first(); ?>
<tr>

    <td>
        <div class="d-flex align-items-center">
            <a href="/product/{{ $orderitem->product_id }}">
                <img style="width: 100px; height:100px}}" src="{{ url('images/products', $product->image) }}"
                    alt="" class="img-thumbnail" />
            </a>

        </div>
    </td>
    <td>
        <p class="fw-normal mb-1">{{ $orderitem->quantity }}</p>
    </td>
    <td>
        <p class="fw-normal mb-1">{{ $product->price }}</p>
    </td>
    <td>
        <span class="badge badge-success rounded-pill d-inline">{{ $orderitem->status }}</span>
    </td>
    <td>
        <span class="badge badge-success rounded-pill d-inline">{{ $orderitem->order->payment->status }}</span>
        <form action="{{ route('user.payment.update', ['user'=>auth()->user()->id,'payment'=>$orderitem->order->payment->id]) }}" method="POST">
            @csrf
            @method("PUT")
            <select class="form-input" name="payment_status" id="payment_status">
                <option value="Awaiting">Awaiting</option>
                <option value="Completed">Completed</option>
                <option value="Failed">Failed</option>
                <option value="Canceled">Canceled</option>
            </select>
            <button type="submit" class="btn btn-primary btn-sm">Update</button>
        </form>
    </td>
    <td>{{ $orderitem->created_at }}</td>
</tr>
