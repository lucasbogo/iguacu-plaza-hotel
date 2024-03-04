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
            <!-- Adjusted for direct links -->
            <li class="{{ Request::is('receptionist/rental-units*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('receptionist.rental-units.index') }}">
                    <i class="fa fa-building"></i> <span>Quartos</span>
                </a>
            </li>
            <li class="{{ Request::is('receptionist/occupants/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('receptionist.occupants.index') }}">
                    <i class="fa fa-users"></i> <span>Mensalistas</span>
                </a>
            </li>
            <li class="{{ Request::is('receptionist/logs*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('receptionist.logs.index') }}">
                    <i class="fa fa-book"></i> <span>Logs</span>
                </a>
            </li>
            <li class="dropdown {{ Request::is('receptionist/employees*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-id-badge"></i>
                    <span>Funcionários</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('receptionist.employees.index') }}">Ver Funcionários</a>
                    </li>
                    <!-- Add more links here as needed -->
                </ul>
            </li>
            <!-- Optimized for dropdown -->
            <li class="dropdown {{ Request::is('receptionist/room_services*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-cutlery"></i>
                    <span>Serviços de Quarto</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('receptionist.service-types.index') }}">Tipos de Serviço</a>
                    </li>
                    <li><a class="nav-link" href="{{ route('receptionist.room-services.index') }}">Serviços</a></li>
                    <li><a class="nav-link" href="{{ route('receptionist.room-services.notPaid') }}">Não Pagos</a></li>
                    <li><a class="nav-link" href="{{ route('receptionist.room-services.paid') }}">Pagos</a></li>
                </ul>
            </li>
            <li class="dropdown {{ Request::is('receptionist/drink-consumables*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fa fa-glass"></i> <span>Consumo de
                        Bebidas</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('receptionist.drink-consumables.index') }}">Bebidas</a></li>
                    <li><a class="nav-link" href="{{ route('receptionist.all-occupant-consumables.index') }}">Cobrar
                            Bebidas</a></li>
                    <li><a class="nav-link" href="{{ route('receptionist.paid-consumables.index') }}">Bebidas Pagas</a>
                    </li>
                    <li><a class="nav-link" href="{{ route('receptionist.employees.allDrinkConsumables') }}">Cobrar
                            Bebidas Funcionários</a></li>
                    <li><a class="nav-link" href="{{ route('receptionist.drink-consumables.paid-employee') }}">Bebidas
                            Pagas Funcionários</a></li>
                </ul>
            </li>
            <li class="dropdown {{ Request::is('receptionist/cashier-closing-records*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fa fa-money"></i> <span>Caixa</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('receptionist.cashier-closing-records.index') }}">Caixa
                            Atual</a></li>
                    <li><a class="nav-link"
                            href="{{ route('receptionist.closed-cashier-closing-records.index') }}">Caixas Fechados</a>
                    </li>
                </ul>
            </li>
            <!-- Add other sidebar items here -->
        </ul>
    </aside>
</div>  
