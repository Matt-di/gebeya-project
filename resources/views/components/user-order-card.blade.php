@props(['order','user','payment'])
<tr>
    <td>
        <div class="d-flex align-items-center">
            <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt="" style="width: 45px; height: 45px"
                class="rounded-circle" />
            <div class="ms-3">
                <p class="fw-bold mb-1">$user->name</p>
                <p class="text-muted mb-0">$user->email</p>
            </div>
        </div>
    </td>
    <td>
        <p class="fw-normal mb-1">{{$payment->status}}</p>
        <p class="text-muted mb-0">{{$payment->provider}}</p>
    </td>
    
    <td>
        <span class="badge badge-success rounded-pill d-inline">Active</span>
    </td>
    <td>{{$order->total}}</td>
    <td>
        <button type="button" class="btn btn-link btn-sm btn-rounded">
            Edit
        </button>
    </td>
</tr>
