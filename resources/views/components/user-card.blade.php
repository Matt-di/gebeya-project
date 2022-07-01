@props(['user', 'orders'])
<tr>
    <td>
        <div class="d-flex align-items-center">
            <a href="/orders/{{ $user->id }}"> {{ $user->id }}</a>
            <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt="" style="width: 45px; height: 45px"
                class="rounded-circle" />

        </div>
    </td>
    <td>
        <div class="ms-3">
            <p class="fw-bold mb-1">{{ $user->name }}</p>
            <p class="text-muted mb-0">{{ $user->email }}</p>
        </div>
        </div>
    </td>
    <td>
        <p class="fw-normal mb-1">{{ $orders->count() }}</p>
        {{-- <p class="text-muted mb-0">{{ $orders->count() }}</p> --}}
    </td>

    <td>
        <span class="badge badge-success rounded-pill d-inline"> </span>
    </td>
    <td>
        <span>
            <button type="button" class="btn btn-primary btn-sm btn-rounded">
                Edit
            </button>
            <button type="button" class="btn btn-warning btn-sm btn-rounded">
                Disable
            </button>

    </td>
</tr>
