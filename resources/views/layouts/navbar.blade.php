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

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Navbar brand -->
                <a class="navbar-brand mt-2 mt-lg-0" href="/">
                    <img src="https://mdbcdn.b-cdn.net/img/logo/mdb-transaprent-noshadows.webp" height="15"
                        alt="MDB Logo" loading="lazy" />
                    Gebeya - Mat
                </a>
                <!-- Left links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href=" {{ route('products') }}">All Products</a>
                    </li>
                    @auth('web')
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

                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="#">Some things</a>
                        </li>
                        <form class="d-flex input-group w-auto">
                            <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                                aria-describedby="search-addon" />
                            <span class="input-group-text border-0" id="search-addon">
                                <i class="fas fa-search"></i>
                            </span>
                        </form>
                    @endguest


                    @auth('web_admin')
                        <li class="nav-item">
                            <div class="dropdown nav-link">
                                <a class="text-reset me-3 dropdown-toggle " href="#" id="anavbarDropdownMenuLink"
                                    role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                                    Manage Customer
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="anavbarDropdownMenuLink">
                                    <li>
                                        <a class="dropdown-item" href="#">Merchant</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">Stores</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endauth
                </ul>
                <!-- Left links -->
            </div>
            <!-- Collapsible wrapper -->

            <!-- Right elements -->
            <div class="d-flex align-items-center">
                <!-- Icon -->
                @if (auth()->user() && auth()->user()->user_type == ' client')
                    <a class="btn btn-primary btn-lg" data-toggle="modal" data-target="#cart-modal-ex">
                        <i class="fa fa-shopping-cart left"></i>
                        <span>Open my cart</span>
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
                            <a class="dropdown-item" href="#">Some news</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Another news</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </li>
                    </ul>
                </div>
                <!-- Avatar -->
                @auth
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
                            <li>
                                <a class="dropdown-item" href="order">My Orders</a>
                            </li>
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
                        <a href=" {{ route('login') }} " class="btn btn-link px-3 me-2">
                            Login
                        </a>
                        <a href=" {{ route('register') }} " class="btn btn-primary me-3">
                            Sign up
                        </a>

                    @endguest
                </div>
                <!-- Right elements -->
            </div>
            <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
</header>
