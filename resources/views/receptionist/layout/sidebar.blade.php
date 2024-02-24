<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand text-center">
            <a href="{{ route('receptionist.dashboard') }}">
                <img src="{{ asset('uploads/logo-hotel.png') }}" alt="Logo" style="padding: 10px;">
            </a>
            <h4 style="margin-top: 10px; font-weight: bold;"></h4><br>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('receptionist.dashboard') }}"></a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ Request::is('receptionist/rental-units*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('receptionist.rental-units.index') }}">
                    <i class="fa fa-building"></i> <span>Quartos</span>
                </a>
            </li>
            <li class="{{ Request::is('receptionist/occupants/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('receptionist.occupants.index') }}">
                    <i class="fa fa-users"></i> <span>Ocupação</span>
                </a>
            </li>
            <li class="nav-item dropdown {{ Request::is('receptionist/room_services*') ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" href="#" id="roomServicesDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-bell"></i> <span>Serviços & Consumo</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="roomServicesDropdown">
                    <a class="dropdown-item" href="{{ route('receptionist.service-types.index') }}"
                        class="{{ Request::is('receptionist/service-types*') ? 'active' : '' }}">Tipos de Serviço</a>
                    <a class="dropdown-item" href="{{ route('receptionist.room-services.index') }}"
                        class="{{ Request::is('receptionist/room-services*') ? 'active' : '' }}">Serviços</a>
                    <a class="dropdown-item" href="{{ route('receptionist.drink-consumables.index') }}"
                        class="{{ Request::is('receptionist/drink-consumables*') ? 'active' : '' }}">Bebidas</a>
                    <a class="dropdown-item" href="{{ route('receptionist.all-occupant-consumables.index') }}">Cobrar
                        Bebidas</a>
                    <a class="dropdown-item" href="{{ route('receptionist.paid-consumables.index') }}">Consumíveis
                        Pagos</a>
                </div>
            </li>

            <!-- Add other sidebar items here -->
        </ul>
    </aside>
</div>
