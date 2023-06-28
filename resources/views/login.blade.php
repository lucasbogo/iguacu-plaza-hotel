@include('nav')


<h1>Bem-vindo ao Iguaçu Plaza Hotel</h1>

<form action="/login" method="POST">
    @csrf
    <input type="text" name="email" placeholder="E-mail">
    <input type="password" name="password" placeholder="Senha">
    <button type="submit">Entrar</button>

    <div style="margin-top:10px;">
        <input type="submit" value="Registrar">
        <br>
        <a href="{{ route('forget-password') }}">Esqueceu a senha?</a>
    </div>