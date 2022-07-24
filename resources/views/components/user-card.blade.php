@props(['user', 'orders'])
<tr>
    <td>
        <div class="d-flex align-items-center">
            <a href="/orders/{{ $user->id }}"> {{ $user->firstname }}</a>


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
        @switch($user->role)
            @case(1)
                <p class="fw-normal mb-1">Admin</p>
            @break

            @case(2)
                <p class="fw-normal mb-1">Merchant</p>
            @break

            @case(3)
                <p class="fw-normal mb-1">Customer</p>
            @break

            @default
        @endswitch

    </td>
    <td>
        <div class="btn-group" role="group" aria-label="Second group">

            @if (auth()->user()->role == 1)
                <div>

                    <a href="{{ route('admin.users.edit', $user->id) }}" type="submit"
                        class="btn btn-warning btn-rounded btn-sm m-2">
                        <i class="fas fa-edit mr-2" aria-hidden="true"> </i>Edit
                    </a>
                </div>
                @if ($user->role != 1)
                    <div>

                        <form action=" {{ route('admin.users.destroy', $user->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-rounded btn-sm m-2">
                                <i class="fas fa-trash mr-2" aria-hidden="true"> </i>Remove
                            </button>
                        </form>
                    </div>
                @endif
            @else
                <p>No Action</p>
            @endif
        </div>


    </td>
</tr>
