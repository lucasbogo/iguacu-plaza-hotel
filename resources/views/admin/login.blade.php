<h3>Login Admin</h3>

<form action="{{ route('admin_login_submit') }}" method="post">
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
    </div>
</form>
