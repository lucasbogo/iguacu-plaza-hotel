<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin_home') }}">
                <img src="{{ asset('uploads/favicon.ico') }}" alt="Logo" alt="Logo" style="padding: 10px;"></a>
            <span>Configurações</span>
        </div>

        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin_home') }}"></a>
        </div>

        <ul class="sidebar-menu">

            <li class="active"><a class="nav-link" href="{{ route('admin_home') }}"><i class="fa fa-hand-o-right"></i>
                    <span>Dashboard</span></a></li>

            {{-- <li class="nav-item dropdown active">
                <a href="#" class="nav-link has-dropdown"><i class="fa fa-hand-o-right"></i><span>Dropdown
                        Items</span></a>
                <ul class="dropdown-menu">
                    <li class="active"><a class="nav-link" href=""><i class="fa fa-angle-right"></i>
                            Item 1</a></li>
                    <li class=""><a class="nav-link" href=""><i class="fa fa-angle-right"></i>
                            Item 2</a></li>
                </ul>
            </li> --}}

            <li class=""><a class="nav-link" href="{{ route('admin_slider') }}"><i class="fa fa-hand-o-right"></i>
                    <span>Fotos Slide</span></a></li>

            <li class=""><a class="nav-link" href="{{ route('admin_feature') }}"><i
                        class="fa fa-hand-o-right"></i>
                    <span>Ícones Características</span></a></li>



        </ul>
    </aside>
</div>
