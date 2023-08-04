<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand text-center">
            <a href="{{ route('admin_home') }}">
                <img src="{{ asset('uploads/logo-hotel.png') }}" alt="Logo" style="padding: 10px;">
            </a>
            <h4 style="margin-top: 10px; font-weight: bold;">Configurações</h4>
        </div>


        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin_home') }}"></a>
        </div>

        <ul class="sidebar-menu">

            <li class="{{ Request::is('admin/home') ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_home') }}"><i class="fa fa-home"></i>
                    <span>Dashboard</span></a></li>

            <li class="nav-item dropdown {{ Request::is('admin/page/about') ? 'active' : ''}}">
                <a href="#" class="nav-link has-dropdown"><i class="fa fa-hand-o-right"></i><span>Páginas</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/page/about') ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_page_about')}}"><i class="fa fa-angle-right"></i>
                            Página Sobre o Hotel</a></li>
                    <li class=""><a class="nav-link" href=""><i class="fa fa-angle-right"></i>
                            Página Contato</a></li>
                </ul>
            </li>

            <li class="{{ Request::is('admin/slide/*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_slider') }}"><i class="fa fa-hand-o-right"></i>
                    <span>Imagens Slide</span></a></li>

            <li class="{{ Request::is('admin/feature/*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_feature') }}"><i
                        class="fa fa-hand-o-right"></i>
                    <span>Ícones/Características</span></a></li>

            <li class="{{ Request::is('admin/testimonial/*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_testimonial') }}"><i
                        class="fa fa-hand-o-right"></i>
                    <span>Avaliações</span></a></li>

            <li class="{{ Request::is('admin/blog/*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_blog') }}"><i class="fa fa-hand-o-right"></i>
                    <span>Blog</span></a></li>

            <li class="{{ Request::is('admin/image/*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_image') }}"><i class="fa fa-hand-o-right"></i>
                    <span>Galeria de Fotos</span></a></li>

            <li class="{{ Request::is('admin/video/*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_video') }}"><i class="fa fa-hand-o-right"></i>
                    <span>Galeria de Vídeos</span></a></li>

            <li class="{{ Request::is('admin/faq/*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_faq') }}"><i class="fa fa-hand-o-right"></i>
                    <span>Perguntas Frequentes</span></a></li>
        </ul>
    </aside>
</div>
