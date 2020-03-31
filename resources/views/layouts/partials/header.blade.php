<header class="section-header">
    <nav class="navbar navbar-dark navbar-expand p-0 bg-primary">
        <div class="container">
            <ul class="nav mr-auto d-none d-md-flex">
                <li><a href="https://www.facebook.com/shop.piesetv" class="nav-link px-2"> <i class="fab fa-facebook"></i> </a></li>
                <li><a href="https://www.instagram.com/shop.piesetv/" class="nav-link px-2"> <i class="fab fa-instagram"></i> </a></li>
            </ul>
            {{-- 
            <ul class="navbar-nav d-none d-md-flex mr-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Acasa</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('faq') }}">Livrare & Metode de plata</a></li>
            </ul>
            --}}

            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('faq') }}" class="nav-link"> Livrare </a></li>
                <li class="nav-item"><a href="#" class="nav-link"> Ajutor </a></li>
                {{-- <li class="nav-item"><a href="#" class="nav-link"> Call: No Phone Give </a></li>
                <li class="nav-item dropdown">
                     <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"> Romana </a>
                    <ul class="dropdown-menu dropdown-menu-right" style="max-width: 100px;">
                        <li><a class="dropdown-item" href="#">English</a></li>
                        <li><a class="dropdown-item" href="#">Russian </a></li>
                    </ul>
                </li>
                --}}
            </ul>
        </div>
    </nav>

    <section class="header-main border-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-2 col-6">
                    <a href="{{ route('home') }}" class="brand-wrap"><span class="ef">PieseTV</span> Shop</a>
                </div>

                <div class="col-lg-6 col-12 col-sm-12">
                    <form action="#" class="search">
                        <div class="input-group w-100">
                            <input type="text" class="form-control" placeholder="Search">
                            <div class="input-group-append">
                              <button class="btn btn-primary" type="submit">
                                <i class="fa fa-search"></i>
                              </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="widgets-wrap float-md-right">
                        <div class="widget-header  mr-3">
                            <a href="{{ route('cart.index') }}" class="icon icon-sm rounded-circle border"><i class="fa fa-shopping-cart"></i></a>
                            <span class="badge badge-pill badge-danger notify">{{ Cache::get('cart_items', '0') }}</span>
                        </div>

                        <div class="widget-header icontext">
                            <a href="#" class="icon icon-sm rounded-circle border"><i class="fa fa-user"></i></a>
                            <div class="text">
                                <span class="text-muted">Salut, @guest Vizitator @else {{ Auth::user()->name }} @endguest</span>
                                @guest
                                <div>
                                    <a href="{{ route('login') }}">{{ __('Login') }}</a> @if (Route::has('register'))|  
                                    <a href="{{ route('register') }}"> {{ __('Register') }}</a> @endif
                                </div>
                                @else
                                <div>
                                    <a href="/myaccount" data-toggle="dropdown" class="dropdown-toggle"> Cont-ul Meu </a>
                                    <ul class="dropdown-menu dropdown-menu-right" style="max-width: 100px;">
                                        <li><a class="dropdown-item" href="{{ route('user.profile') }}">Contul meu</a></li>
                                        <li><a class="dropdown-item" href="#">Comenziile mele</a></li>
                                        <li><a class="dropdown-item" href="#">Garantiile mele</a></li>
                                        <li><a class="dropdown-item" href="#">Date personale</a></li>
                                        <li><a class="dropdown-item" href="#">Setari siguranta</a></li>
                                        <div class="dropdown-divider"></div>
                                        @if(Auth::user()->role_id == 1)
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">Admin Panel</a>
                                        @endif
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </ul>
                                </div>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</header>