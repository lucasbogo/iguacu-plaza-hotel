<style>
    .contact-info {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .contact-info li {
        display: inline;
        margin-right: 20px;
    }

    .contact-info li:last-child {
        margin-right: 0;
    }
</style>

<div class="top">
    <div class="container">
        <div class="row">

            <div class="col-md-7 left-side">
                <ul class="contact-info">
                    <li>
                        @if (!empty($global_setting->top_bar_whatsapp_link))
                            <a href="{{ $global_setting->top_bar_whatsapp_link }}" target="_blank">
                                <i class="fab fa-whatsapp"></i> {{ $global_setting->top_bar_whatsapp }}
                            </a>
                        @else
                            <a href="{{ $global_setting->top_bar_whatsapp_link }}" target="_blank">
                                <i class="fab fa-whatsapp"></i> {{ $global_setting->top_bar_whatsapp }}
                            </a>
                        @endif
                    </li>

                    <li>
                        <i class="fa fa-phone"></i> {{ $global_setting->top_bar_phone }}
                    </li>

                    <li>
                        <i class="fa fa-envelope"></i> {{ $global_setting->top_bar_email }}
                    </li>
                </ul>
            </div>

            <div class="col-md-5 right-side">
                <ul class="right">
                    @if ($global_page->cart_status == 1)
                        <li class="menu"><a href="{{ route('cart') }}">{{ $global_page->cart_heading }}</a></li>
                    @endif

                    @if ($global_page->checkout_status == 1)
                        <li class="menu"><a href="checkout.html">{{ $global_page->checkout_heading }}</a></li>
                    @endif

                    @auth('customer')
                        <li class="menu"><a href="{{ route('customer.customer_home') }}">Meu Painel</a></li>
                        <li class="menu"><a href="{{ route('customer_logout') }}">Sair</a></li>
                    @else
                        @if ($global_page->signup_status == 1)
                            <li class="menu"><a
                                    href="{{ route('customer_signup') }}">{{ $global_page->signup_heading }}</a></li>
                        @endif

                        @if ($global_page->signup_status == 1)
                            <li class="menu"><a
                                    href="{{ route('customer_login') }}">{{ $global_page->signin_heading }}</a></li>
                        @endif
                    @endauth
                </ul>
            </div>

        </div>
    </div>
</div>


<div class="navbar-area" id="stickymenu">

    <!-- Menu For Mobile Device -->
    <div class="mobile-nav">
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('uploads/' . $global_setting->logo) }}" alt="">
        </a>
    </div>

    <!-- Menu For Desktop Device -->
    <div class="main-nav">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('uploads/' . $global_setting->logo) }}" alt=""
                        style="max-height: 200px;">
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

                                @foreach ($global_room as $item)
                                    <li class="nav-item">
                                        <a href="{{ route('room_detail', $item->id) }}"
                                            class="nav-link">{{ $item->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>

                        @if ($global_page->image_gallery_status == 1 || $global_page->video_gallery_status == 1)
                            <li class="nav-item">
                                <a href="javascript:void;" class="nav-link dropdown-toggle">Galeria</a>
                                <ul class="dropdown-menu">
                                    @if ($global_page->image_gallery_status == 1)
                                        <li class="nav-item">
                                            <a href="{{ route('image_gallery') }}" class="nav-link">Galeria de
                                                fotos</a>
                                        </li>
                                    @endif

                                    @if ($global_page->video_gallery_status == 1)
                                        <li class="nav-item">
                                            <a href="{{ route('video_gallery') }}" class="nav-link">Galeria de
                                                videos</a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif

                        @if ($global_page->blog_status == 1)
                            <li class="nav-item">
                                <a href="{{ route('blog') }}" class="nav-link">Blog</a>
                            </li>
                        @endif

                        @if ($global_page->contact_status == 1)
                            <li class="nav-item">
                                <a href="{{ route('contact') }}" class="nav-link">Contato</a>
                            </li>
                        @endif

                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>
