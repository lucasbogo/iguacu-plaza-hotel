<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fa fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                        class="fa fa-search"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                @php $receptionistPhoto = Auth::guard('receptionist')->user()->photo; @endphp
                <img src="{{ $receptionistPhoto ? asset('uploads/receptionist/' . $receptionistPhoto) : asset('path/to/default/image.png') }}"
                    alt="Profile Picture" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">{{ Auth::guard('receptionist')->user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('receptionist.profile.show') }}" class="dropdown-item has-icon">
                    <i class="fa fa-user"></i> Editar perfil
                </a>
                <form action="{{ route('receptionist.logout') }}" method="POST" style="display: none;" id="logout-form">
                    @csrf
                </form>
                <a href="#" class="dropdown-item has-icon text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i> Sair
                </a>
            </div>
            
        </li>
    </ul>
</nav>
