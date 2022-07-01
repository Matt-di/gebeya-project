<header class="mb-5">
    <nav class="navbar navbar-expand-md navbar-light bg-white fixed-top">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <!-- Left links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <a class="navbar-brand mt-2 mt-lg-0" href="/admin/dashboard">
                        Gebeya - Mat
                    </a>

                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('store.products') }}">All
                            Products</a>
                    </li>

                    @auth('web_admin')
                        <li class="nav-item">
                            <div class="dropdown nav-link">
                                <a class="text-reset me-3 dropdown-toggle " href="#" id="anavbarDropdownMenuLink"
                                    role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                                    Admins
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="anavbarDropdownMenuLink">
                                    <li class="nav-item">
                                        <button class="dropdown-item btn nav-link" data-mdb-toggle="modal"
                                            data-mdb-target="#addAdminModal">
                                            <i class="fas fa-plus mr-5" aria-hidden="true"> Add Admin</i>
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <a class="btn dropdown-item" href="{{ route('admin.users') }}">List</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown nav-link">
                                <a class="text-reset me-3 dropdown-toggle " href="#" id="manageCustomerDropdown"
                                    role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                                    Manage Customer
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="manageCustomerDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('system.users') }}">Merchant</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('store.products') }}">Stores</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endauth
                    @auth('web')
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ auth() == 'merchant' ? route('products') : route('home') }}">All
                                Products</a>
                        </li> --}}
                        @if (auth()->user()->user_type == 'merchant')
                            @isset($categories)
                                @foreach ($categories as $category)
                                    @if ($category->show_nav == 1)
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ route('category.products', $category->id) }}">{{ $category->name }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            @endisset
                        @endif

                    @endauth

                    @guest()
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ auth() == 'merchant' ? route('products') : route('home') }}">All
                                Products</a>
                        </li> --}}
                    @endguest
                </ul>
                <!-- Left links -->
            </div>
            <!-- Collapsible wrapper -->

            <!-- Right elements -->
            <div class="d-flex align-items-center mr-2">
                <form class="d-flex input-group w-auto" action="/" method="GET">
                    <input type="search" name="search" class="form-control rounded" placeholder="Search"
                        aria-label="Search" aria-describedby="search-addon" />
                    <button type="submit" class="link-text"> <span class="input-group-text border-0" id="search-addon">
                            <i class="fas fa-search"></i>
                        </span></button>
                </form>
            </div>
            <div class="d-flex align-items-center mr-2">
                @if (auth()->user() && auth()->user()->user_type == 'client')
                    <a class="text-reset me-3" href="{{ route('cart') }}">
                        <i class="fas fa-shopping-cart fa-lg"></i>
                        <span
                            class="badge rounded-pill badge-notification bg-danger">{{ auth()->user()->carts()->count() }}</span>
                    </a>
                @endif

                <!-- Notifications -->
                <div class="dropdown">
                    <a class="text-reset me-3 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink"
                        role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                        <span class="badge rounded-pill badge-notification bg-danger">1</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        <li>
                            <a class="dropdown-item" href="#">Notifications</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Message</a>
                        </li>
                    </ul>
                </div>
                <!-- Avatar -->
                @auth()
                    <div class="dropdown">
                        <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#"
                            id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                            <img src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp" class="rounded-circle" height="25"
                                alt="Black and White Portrait of a Man" loading="lazy" />
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                            <li>
                                <a class="dropdown-item" href="#">Account</a>
                            </li>
                            @if (auth()->user()->user_type == 'client')
                                <li>
                                    <a class="dropdown-item" href="{{ route('orders') }}">My Orders</a>
                                </li>
                            @endif

                            <li>
                                <a class="dropdown-item" href="#">Settings</a>
                            </li>
                            <li>
                                <form action=" {{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth

                @guest
                    <div class="d-flex align-items-center">
                        <a href=" {{ route('login') }} " class="btn btn-primary px-3 me-2">
                            Login
                        </a>
                        <a href=" {{ route('register') }} " class="btn btn-primary">
                            Sign up
                        </a>

                    @endguest
                </div>
                <!-- Right elements -->
            </div>
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
</header>
