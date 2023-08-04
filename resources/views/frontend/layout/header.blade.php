<div class="top">
    <div class="container">
        <div class="row">
            <div class="col-md-6 left-side">
                <ul>
                    <li class="phone-text">+55 (45) 99919-0001</li>
                    <li class="email-text">reservas@iguacuplazahotel.com.br</li>
                </ul>
            </div>
            <div class="col-md-6 right-side">
                <ul class="right">
                    <li class="menu"><a href="cart.html">Carrinho</a></li>
                    <li class="menu"><a href="checkout.html">Checkout</a></li>
                    <li class="menu"><a href="signup.html">Registrar</a></li>
                    <li class="menu"><a href="login.html">Login</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="navbar-area" id="stickymenu">

    <!-- Menu For Mobile Device -->
    <div class="mobile-nav">
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('uploads/logo-hotel.png') }}" alt="">
        </a>
    </div>

    <!-- Menu For Desktop Device -->
    <div class="main-nav">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('uploads/logo-hotel.png') }}" alt="" style="max-height: 200px;">
                </a>
                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link">Home</a>
                        </li>
                        @if ($global_page->about_status == 1)
                            <li class="nav-item">
                                <a href="{{ route('about') }}" class="nav-link">Sobre nós</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a href="javascript:void;" class="nav-link dropdown-toggle">Quartos</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="room-detail.html" class="nav-link">Regular Couple Bed</a>
                                </li>
                                <li class="nav-item">
                                    <a href="room-detail.html" class="nav-link">Delux Couple Bed</a>
                                </li>
                                <li class="nav-item">
                                    <a href="room-detail.html" class="nav-link">Regular Double Bed</a>
                                </li>
                                <li class="nav-item">
                                    <a href="room-detail.html" class="nav-link">Delux Double Bed</a>
                                </li>
                                <li class="nav-item">
                                    <a href="room-detail.html" class="nav-link">Premium Suite</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void;" class="nav-link dropdown-toggle">Galeria</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="{{ route('image_gallery') }}" class="nav-link">Galeria de fotos</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('video_gallery') }}" class="nav-link">Galeria de videos</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('blog') }}" class="nav-link">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a href="contact.html" class="nav-link">Contato</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>
