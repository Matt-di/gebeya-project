@props(['user','orders','orderItems'])
<tr>
    <td>
        <div class="d-flex align-items-center">
            <a href="/orders/{{$user->id}}"> {{$user->id}}</a>
            <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt="" style="width: 45px; height: 45px"
                class="rounded-circle" />
            <div class="ms-3">
        <p class="fw-bold mb-1">{{$user->name}}</p>
                <p class="text-muted mb-0">{{$user->email}}</p>
            </div>
        </div>
    </td>
    <td>
        <p class="fw-normal mb-1">{{$orders->count()}}</p>
        <p class="text-muted mb-0">{{$orders->count()}}</p>
    </td>
    
    <td>
        <span class="badge badge-success rounded-pill d-inline">Active</span>
    </td>
    <td>{{$orderItems->count()}}</td>
    <td>
        <button type="button" class="btn btn-link btn-sm btn-rounded">
            Edit
        </button>
    </td>
</tr>
