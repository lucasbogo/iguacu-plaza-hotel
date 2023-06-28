@include('nav')


<h3>Esqueceu sua senha? Insira seu e-mail para receber o link para criar uma senha nova.</h3>

<form action="{{ route('forget_password_submit') }}" method="POST">
    @csrf
    <div>Email</div>
    <div><input type="text" name="email"></div>

<div style="margin-top:10px;">
    <input type="submit" value="Registrar">
    <br><br>
    <a href="{{ route('login') }}">Já tem uma conta? Faça login</a>
</div>