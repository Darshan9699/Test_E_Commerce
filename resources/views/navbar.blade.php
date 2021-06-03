<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Offcanvas Menu Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
    <div class="offcanvas__close">+</div>
    <ul class="offcanvas__widget">
        <li><span class="icon_search search-switch"></span></li>
        <li><a href="#"><span class="icon_heart_alt"></span>
            <div class="tip">2</div>
        </a></li>
        <li><a href="#"><span class="icon_bag_alt"></span>
            <div class="tip">2</div>
        </a></li>
    </ul>
    <div class="offcanvas__logo">
        <a href="./index.html"><img src="img/logo.png" alt=""></a>
    </div>
    <div id="mobile-menu-wrap"></div>
    <div class="offcanvas__auth">
        <a href="#">Login</a>
        <a href="#">Register</a>
    </div>
</div>
<!-- Offcanvas Menu End -->

<!-- Header Section Begin -->
<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-lg-2">
                <div class="header__logo">
                    <a href="{{ route('index')  }}"><img src="{{ asset('img/logo.png') }}" alt=""></a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-7">
                <nav class="header__menu">
                    <ul>
                        <li class="active"><a href="{{ route('index') }}">Home</a></li>
                        <li><a href="{{ route('shop.index') }}">Shop</a></li>
                    </ul>
                </nav>
            </div>
            @guest
                <div class="col-lg-3">
                    <div class="header__right">
                        <div class="header__right__auth">
                            <a href="{{ route('login') }}">Login</a>
                            <a href="{{ route('register') }}">Register</a>
                        </div>
                        <ul class="header__right__widget">
                            <li><span class="icon_search search-switch"></span></li>
                                <a href="{{ route('cart.index') }}">
                                    <span class="icon_bag_alt"></span>
                                    @if (Cart::instance('default')->count() > 0 )
                                        <div class="tip">{{ Cart::instance('default')->count() }}</div>
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            @else
                <div class="col-lg-3">
                    <div class="header__right">
                        <div class="header__right__auth">
                            <a href="#" style="text-transform: capitalize;">{{ auth()->user()->name }}
                                <img style="height: 2rem;width: 2rem;" class="img-profile rounded-circle"
                                src="{{ asset('img/instagram/insta-6.jpg') }}" alt="">
                            </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <a  href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ _('Logout') }}
                                </a>
                        </div>
                        <ul class="header__right__widget">
                            <li><span class="icon_search search-switch"></span></li>
                                    <a href="{{ route('cart.index') }}">
                                    <span class="icon_bag_alt"></span>
                                    @if (Cart::instance('default')->count() > 0 )
                                        <div class="tip">{{ Cart::instance('default')->count() }}</div>
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            @endguest

            {{-- <div class="col-lg-3">
                <div class="header__right">
                    <nav class="header__menu">
                        @guest
                        <div class="header__right__auth">
                            <a href="{{ route('register') }}">Sign Up</a>
                            <a href="{{ route('login') }}">Login</a>
                        </div>
                            <ul class="header__right__widget">
                                <li><span class="icon_search search-switch"></span></li>
                                    <a href="{{ route('cart.index') }}">
                                        <span class="icon_bag_alt"></span>
                                        @if (Cart::instance('default')->count() > 0 )
                                        <div class="tip">{{ Cart::instance('default')->count() }}</div>
                                        @endif
                                    </a>
                                </li>
                            </ul>
                            @else
                                <li>
                                    <a href="#" style="text-transform: capitalize;">{{ auth()->user()->name }}
                                        <img style="height: 2rem;width: 2rem;" class="img-profile rounded-circle"
                                        src="{{ asset('img/instagram/insta-6.jpg') }}" alt="">
                                    </a>
                                    <ul class="dropdown">
                                    <li><form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    <a  href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a></a></li>
                                    </ul>
                                </li>
                                <li><span class="icon_search search-switch"></span></li>
                                <li>
                                    <a href="{{ route('cart.index') }}">
                                        <span class="icon_bag_alt"></span>
                                        @if (Cart::instance('default')->count() > 0 )
                                        <div class="tip">{{ Cart::instance('default')->count() }}</div>
                                        @endif
                                    </a>
                                </li>
                            </ul>
                            @endguest
                        </div>
                    </nav>
                </div>

            </div> --}}
        </div>
        <div class="canvas__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->
