@props(['order'])

{{-- {{dd($order)}} --}}
<tr>
    <td>
        <div class="d-flex align-items-center">
            <a href="/product/{{ $order->id }}"> Order</a>
        </div>
    </td>
    <td>
        <p class="fw-normal mb-1">{{ $order->total }}</p>
    </td>

    <td>
        <span class="badge badge-success rounded-pill d-inline">{{ $order->status }}</span>
    </td>
    <td>{{ $order->created_at->diffForHumans() }} <br />
        {{ $order->created_at->format('j F, Y H:m:s') }}</td>
    <td>
        <a href="/{{auth()->user()->id}}/orders/{{$order->id}}" class="btn btn-link btn-sm btn-rounded">
            Details
        </a>
    </td>
</tr>
