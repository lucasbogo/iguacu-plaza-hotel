@include('admin.layout.nav')

<h3>Painel Admin</h3>

<p>Olá, {{ Auth::guard('admin')->user()->name }}</p>