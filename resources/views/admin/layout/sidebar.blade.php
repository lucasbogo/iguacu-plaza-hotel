<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand text-center">
            <a href="{{ route('admin_home') }}">
                <img src="{{ asset('uploads/logo-hotel.png') }}" alt="Logo" style="padding: 10px;">
            </a>
            <h4 style="margin-top: 10px; font-weight: bold;"></h4><br>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin_home') }}"></a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ Request::is('admin/home') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('admin_home') }}"><i class="fa fa-home"></i>
                    <span>Dashboard</span></a></li>

            <li class="{{ Request::is('admin/setting') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('admin_setting') }}"><i class="fa fa-cog"></i>
                    <span>Configurações</span></a></li>

            <li class="nav-item dropdown {{ Request::is('admin/amenity/view') || Request::is('admin/room/view') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fa fa-building"></i><span> Hotel</span></a>
                <ul class="dropdown-menu">

                    <li class="{{ Request::is('admin/amenity/view') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin_amenity') }}"><i class="fa fa-angle-right"></i> Comodidades</a>
                    </li>

                    <li class="{{ Request::is('admin/room/view') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin_room') }}"><i class="fa fa-angle-right"></i> Quartos</a>
                    </li>
                </ul>
            </li>
            <li
                class="nav-item dropdown {{ Request::is('admin/page/about') ||
                Request::is('admin/page/terms') ||
                Request::is('admin/page/privacy') ||
                Request::is('admin/page/image-gallery') ||
                Request::routeIs('admin_page_video_gallery') ||
                Request::is('admin/page/privacy') ||
                Request::is('admin/page/faq') ||
                Request::is('admin/page/blog') ||
                Request::is('admin/page/room') ||
                Request::is('admin/page/contact') ||
                Request::is('admin/page/cart') ||
                Request::is('admin/page/checkout') ||
                Request::is('admin/page/payment') ||
                Request::is('admin/page/signup') ||
                Request::is('admin/page/signin') ||
                Request::is('admin/page/forget_password') ||
                Request::is('admin/page/reset_password')
                    ? 'active'
                    : '' }}">
                <a href="#" class="nav-link has-dropdown" title="Editar títulos e status das páginas"><i
                        class="fa fa-tasks"></i><span>Páginas</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/page/about') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin_page_about') }}"><i class="fa fa-angle-right"></i>
                            Sobre o Hotel</a></li>
                    <li class="{{ Request::is('admin/page/terms') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin_page_terms') }}"><i class="fa fa-angle-right"></i>
                            Termos e Condições</a></li>
                    <li class="{{ Request::is('admin/page/privacy') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin_page_privacy') }}"><i class="fa fa-angle-right"></i>
                            Política de Privacidade</a></li>
                    <li class="{{ Request::is('admin/page/image-gallery') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin_page_image_gallery') }}"><i class="fa fa-angle-right"></i>
                            Galeria de Imagens</a></li>
                    <li class="{{ Request::routeIs('admin_page_video_gallery') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin_page_video_gallery') }}"><i class="fa fa-angle-right"></i>
                            Galeria de Vídeos</a></li>
                    <li class="{{ Request::is('admin/page/faq') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin_page_faq') }}"><i class="fa fa-angle-right"></i>
                            Perguntas Frequentes</a></li>
                    <li class="{{ Request::is('admin/page/blog') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin_page_blog') }}"><i class="fa fa-angle-right"></i>
                            Blog</a></li>
                    <li class="{{ Request::is('admin/page/room') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin_page_room') }}"><i class="fa fa-angle-right"></i>
                            Quartos</a></li>
                    <li class="{{ Request::is('admin/page/contact') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin_page_contact') }}"><i class="fa fa-angle-right"></i>
                            Contato</a></li>
                    <li class="{{ Request::is('admin/page/cart') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin_page_cart') }}"><i class="fa fa-angle-right"></i>
                            Carrinho</a></li>
                    <li class="{{ Request::is('admin/page/checkout') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin_page_checkout') }}"><i class="fa fa-angle-right"></i>
                            Checkout</a></li>
                    <li class="{{ Request::is('admin/page/payment') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin_page_payment') }}"><i class="fa fa-angle-right"></i>
                            Pagamento</a></li>
                    <li class="{{ Request::is('admin/page/signup') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin_page_signup') }}"><i class="fa fa-angle-right"></i>
                            Registrar</a></li>
                    <li class="{{ Request::is('admin/page/signin') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin_page_signin') }}"><i class="fa fa-angle-right"></i>
                            Login</a></li>
                    <li class="{{ Request::is('admin/page/forget_password') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin_page_forget_password') }}"><i class="fa fa-angle-right"></i>
                            Esqueceu a Senha</a></li>
                    <li class="{{ Request::is('admin/page/reset_password') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin_page_reset_password') }}"><i class="fa fa-angle-right"></i>
                            Redefinição de Senha</a></li>
                </ul>
            </li>
            <li class="{{ Request::is('admin/slide/*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('admin_slider') }}"><i class="fa fa-picture-o"></i>
                    <span>Imagens Slide</span></a></li>
            <li class="{{ Request::is('admin/feature/*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('admin_feature') }}"><i class="fa fa-font-awesome"></i>
                    <span>Ícones/Características</span></a></li>
            <li class="{{ Request::is('admin/testimonial/*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('admin_testimonial') }}"><i class="fa fa-user-circle"></i>
                    <span>Avaliações</span></a></li>
            <li class="{{ Request::is('admin/blog/*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('admin_blog') }}"><i class="fa fa-commenting"></i>
                    <span>Blog</span></a></li>
            <li class="{{ Request::is('admin/image/*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('admin_image') }}"><i class="fa fa-file-image-o"></i>
                    <span>Galeria de Fotos</span></a></li>
            <li class="{{ Request::is('admin/video/*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('admin_video') }}"><i class="fa fa-youtube"></i>
                    <span>Galeria de Vídeos</span></a></li>
            <li class="{{ Request::is('admin/faq/*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('admin_faq') }}"><i class="fa fa-question-circle"></i>
                    <span>Perguntas Frequentes</span></a></li>
            <li
                class="nav-item dropdown {{ Request::is('admin/subscribers') || Request::is('admin/subscribers/send-email') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" title="Editar títulos e status das páginas">
                    <i class="fa fa-tasks"></i>
                    <span>Inscritos na newsletter</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/subscribers') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin_subscribers') }}">
                            <i class="fa fa-angle-right"></i>
                            Todos os Inscritos
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/subscribers/send-email') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin_subscribers_send_email') }}">
                            <i class="fa fa-angle-right"></i>
                            Enviar E-mail
                        </a>
                    </li>
                </ul>
            </li>
    </aside>
</div>
