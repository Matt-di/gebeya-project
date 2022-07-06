@props(['user'])

<tr>
    <td>
        <div class="d-flex align-items-center">
            <a href="{{route('admin.view',$user->id) }}"> {{ $user->id }}</a>
        </div>
    </td>
    <td>
        <div class="ms-3">
            <p class="fw-bold mb-1">{{ $user->username }}</p>
        </div>
    </td>


    <td>
        <p class="text-muted mb-0">{{ $user->email }}</p>

    </td>
    <td>
        <p class="text-muted mb-0">{{ $user->admin_type }}</p>

    </td>
    <td>
        <span class="table-remove mb-5">
            <button id="{{ $user->id }}" type="button"
                class="btn btn-warning btn-rounded btn-sm my-0 editadmin">
                <i class="fas fa-edit mr-5 ml-3" aria-hidden="true"> Edit</i>
            </button>
        </span>
        <span class="table-remove mt-2">
            <form action=" {{ route('admin.delete', $user->id) }}" method="POST">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger btn-rounded btn-sm my-0">
                    <i class="fas fa-trash " aria-hidden="true"> Remove</i>
                </button>
            </form>
    </td>
</tr>
