<div class="sidebar-fixed top-0 pt-2 ">
    <a class="logo-wrapper waves-effect mb-3">
        <img src="https://mdbootstrap.com/img/logo/mdb-email.png" class="img-fluid" alt="">
    </a>
    <div class="list-group list-group-flush">
        <a href=" {{route('merchant.dashboard')}}" class="list-group-item {{ Request::is('dashboard') ? 'active' : '' }}  waves-effect mt-3">
            <i class="fa fa-pie-chart mr-3"></i>Dashboard
        </a>
        <a href="{{route('products')}}" class="list-group-item list-group-item-action waves-effect mb-3 {{ Request::is('products') ? 'active' : '' }}">
            <i class="fa fa-shopping-basket mr-5"></i>Products</a>
        <a href="{{route('category')}}" class="list-group-item list-group-item-action waves-effect mb-3 {{ Request::is('category') ? 'active' : '' }}">
            <i class="fa fa-table mr-3"></i>Category</a>
        <a href="{{route('orders')}}" class="list-group-item list-group-item-action waves-effect mb-3 {{ Request::is('orders') ? 'active' : '' }}">
            <i class="fa fa-map mr-3"></i>Orders</a>
        <a href="{{route('orders')}}" class="list-group-item list-group-item-action waves-effect mb-3 {{ Request::is('orders') ? 'active' : '' }}">
            <i class="fa fa-money mr-3"></i>Orders</a>
    </div>

</div>