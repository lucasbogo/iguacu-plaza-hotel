@include('user.nav')


<h1>Bem-vindo a Registrar</h1>

<form action="{{ route('register_submit') }}" method="POST">
    @csrf
    <div>Nome</div>
    <div><input type="text" name="name"></div>

    <div>Email</div>
    <div><input type="text" name="email"></div>

    <div>Senha</div>
    <div><input type="password" name="password"></div>

    <div>Confirmar Senha</div>
    <div><input type="password" name="password_confirmation"></div>

    <div style="margin-top:10px;">
        <input type="submit" value="Registrar">
        <br>
        <br>
        <a href="{{ route('login') }}">Já tem uma conta? Faça login</a>
