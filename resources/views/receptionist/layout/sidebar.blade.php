<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand text-center">
            <a href="{{ route('receptionist_home') }}">
                <img src="{{ asset('uploads/logo-hotel.png') }}" alt="Logo" style="padding: 10px;">
            </a>
            <h4 style="margin-top: 10px; font-weight: bold;"></h4><br>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('receptionist_home') }}"></a>
        </div>
        <ul class="sidebar-menu">
                <li class="{{ Request::is('receptionist/room_occupancies/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('receptionist.room_occupancies.index') }}">
                            <i class="fa fa-users"></i> <span>Ocupação</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('receptionist/room_services/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('receptionist.room_services.index') }}">
                            <i class="fa fa-concierge-bell"></i> <span>Serviços Extra</span>
                        </a>
                    </li>
                    
    </aside>
</div>
