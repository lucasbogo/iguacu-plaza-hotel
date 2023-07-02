@include('user.nav')


<form action="{{ route('login_submit') }}" method="post">
    @csrf
    <br>
    <div>Email</div>
    <div>
        <input type="text" name="email">
    </div>

    <div>Senha</div>
    <div>
        <input type="password" name="password">
    </div>

    <div style="margin-top:10px;">
        <input type="submit" value="Login">
        <br><br>
        <a href="{{ route('forget_password') }}">Esqueceu a senha?</a>
    </div>
</form>
