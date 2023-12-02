<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand text-center">
            <a href="{{ route('customer.customer_home') }}">
                <img src="{{ asset('uploads/logo-hotel.png') }}" alt="Logo" style="padding: 10px;">
            </a>
            {{-- <h4 style="margin-top: 10px; font-weight: bold;"></h4> --}}
        </div>
        <br>
        <br>
        <br>
        <br>

        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('customer.customer_home') }}"></a>
        </div>

        <ul class="sidebar-menu">
            <li class="{{ Request::is('customer/home') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('customer.customer_home') }}">
                    <i class="fa fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>


            {{-- <li class="{{ Request::is('customer/order/*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('customer_order_view') }}"><i class="fa fa-hand-o-right"></i> <span>Orders</span></a>
            </li> --}}

        </ul>
    </aside>
</div>
