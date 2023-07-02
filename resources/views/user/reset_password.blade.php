@include('user.nav')


<h3>Redefinir Senha</h3>

<form action="{{ route('reset_password_submit') }}" method="POST">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">
    <input type="hidden" name="email" value="{{ $email }}">

    <div>Nova senha</div>
    <div><input type="password" name="new_password"></div>

    <div>Repetir senha</div>
    <div><input type="password" name="retype_password"></div>

    <div style="margin-top:10px;">
        <input type="submit" value="redefinir senha">
    </div>
