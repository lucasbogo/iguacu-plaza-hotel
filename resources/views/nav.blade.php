<a href="{{ route('home') }}">Home</a>

@if (Auth::guard('web')->user())
    <a href="{{ route('dashboard_user') }}">Dashboard</a>
    <a href="{{ route('settings') }}">Configurações</a>
    <a href="{{ route('logout') }}">Sair</a>
@endif

@if (!Auth::guard('web')->user())
    <a href="{{ route('login') }}">Entrar</a>
    <a href="{{ route('register') }}">Registrar</a>
@endif

<a href="{{ route('forget_password') }}">Esqueceu a senha?</a>
