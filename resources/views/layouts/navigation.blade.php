        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="{{ route('home') }}">Gebeya-Mat</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="/">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('user.stores.index')}}">Stores</a></li>
                        @isset($categories)

                            @foreach ($categories as $category)
                                @if ($category->show_nav == 1)
                                    <li class="nav-item">
                                        <a href="{{ route('userstore', ['id' => $category->user->id, 'category' => $category->id]) }}"
                                            class="nav-link">{{ $category->name }}</a>
                                    </li>
                                @endif
                            @endforeach
                        @endisset
                        {{-- <li class="nav-item">
                            <form class="form-inline" action="{{ route('home') }}">


                                <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search"
                                    aria-label="Search">
                            </form>

                        </li> --}}
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>


                            <li class="nav-item">
                                <a class="btn btn-outline-light " href="{{ route('carts.index', 1) }}" type="submit">
                                    <i class="bi-cart-fill me-1"></i>
                                    <i class="fas fa-shopping-cart"></i>
                                    Cart
                                    <span id="items-in-cart" class="badge bg-dark text-white ms-1 rounded-pill"></span>
                                </a>
                            </li>
                        @endguest
                        @auth
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ auth()->user()->firstname }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @if (auth()->user()->role == 2)
                                        <a class="dropdown-item"
                                            href="{{ route('merchant.dashboard', auth()->user()->id) }}">
                                            {{ __('Dashboard') }}
                                            <a class="dropdown-item"
                                                href="{{ route('merchant.orders.index', auth()->user()->id) }}">
                                                {{ __('Orders') }}
                                            </a>
                                        </a>
                                    @endif

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    
                                </div>
                            </li>
                        @endauth

                </div>
            </div>
        </nav>

