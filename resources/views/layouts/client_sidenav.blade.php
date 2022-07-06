<div class="sidebar ">

    <div class="list-group list-group-flush">
        <a href=" {{ route('user.merchant.dashboard',auth()->user()->id) }}"
            class="list-group-item button-rounded {{ Request::is('dashboard') ? 'active' : '' }}  waves-effect mt-3">
            <i class="fa fa-pie-chart mr-3"></i>Dashboard
        </a>
        <a href="{{ route('user.products',auth()->user()->id) }}"
            class="list-group-item list-group-item-action waves-effect mb-3 {{ Request::is('products') ? 'active' : '' }}">
            <i class="fa fa-shopping-basket mr-5"></i>Products</a>
        <a href="{{ route('user.category',auth()->user()->id) }}"
            class="list-group-item list-group-item-action waves-effect mb-3 {{ Request::is('category') ? 'active' : '' }}">
            <i class="fa fa-table mr-3"></i>Category</a>
        <a href="{{ route('user.merchant.orders',auth()->user()->id) }}"
            class="list-group-item list-group-item-action waves-effect mb-3 {{ Request::is('merchant/orders') ? 'active' : '' }}">
            <i class="fa fa-map mr-3"></i>Orders</a>
        <a href="{{ route('user.users',auth()->user()->id) }}"
            class="list-group-item list-group-item-action waves-effect mb-3 {{ Request::is('users') ? 'active' : '' }}">
            <i class="fa fa-user mr-3"></i>Users</a>
    </div>

</div>
