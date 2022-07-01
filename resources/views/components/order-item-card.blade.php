@props(['orderitem'])

<?php $product = \App\Models\Product::where('id', $orderitem->product_id)->first() ?>
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
    <td>{{ $orderitem->created_at }}</td>
</tr>
