@props(['order', 'user', 'payment'])
<tr>
    <td>
        <div class="d-flex align-items-center">
            <a href="{{ route('merchant.orders.show', ['user' => auth()->user()->id, 'order' => $order->id]) }}">
                {{ $order->id }}</a>

        </div>
    </td>
    <td>
        <div class="ms-3">

            <a href="{{ route('merchant.users.show', ['user' => auth()->user()->id, 'id' => $user->id]) }}">
                <p class="fw-bold mb-1">{{ $user->firstname }}</p>
                <p class="text-muted mb-0">{{ $user->email }}</p>
            </a>
        </div>
        </div>
    </td>
    <td>
        <span class="badge badge-success rounded-pill d-inline">{{ $payment->status }}</span>
    </td>
    <td>
        <p class="text-muted mb-0">{{ $payment->provider }}</p>
    </td>
    <td>
        <p class="text-muted mb-0">{{ $order->status }}</p>

        <form action="{{ route('merchant.userorders.update', ['user' => auth()->user()->id, 'order' => $order->id]) }}"
            method="POST">
            @csrf
            <select class="form-input" name="order_status" id="order_status">
                <option value="ordered">Ordered</option>
                <option value="shipped">Shipped</option>
                <option value="reached">Delivered</option>
            </select>
            <button type="submit" class="btn btn-primary btn-sm">Update</button>
        </form>

    </td>

    <td>{{ $order->total }}</td>
    <td>{{ $payment->amount }}</td>
    <td>
        <a class="btn btn-primary" href="{{ route('merchant.orders.show', ['user' => auth()->user()->id, 'order' => $order->id]) }}">
            Details</a>
    </td>
</tr>
