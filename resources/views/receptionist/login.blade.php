<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <link rel="icon" type="image/png" href="{{ asset('uploads/favicon.ico') }}">

    <style>
        .logo {
            text-align: center;
        }

        .logo img {
            max-width: 100px;
            display: block;
            margin: 0 auto;
        }
    </style>

    <title>Recepcionista</title>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700&display=swap" rel="stylesheet">
    @include('receptionist.layout.styles')
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <section class="section">
                <div class="container container-login">
                    <div class="row">
                        <div
                            class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                            <div class="card card-primary border-box">
                                <div class="card-header card-header-auth">
                                    <img src="{{ asset('uploads/logo-hotel.png') }}" alt="Logo">
                                </div>
                                <div class="card-body card-body-auth">
                                    @if (session()->get('success'))
                                        <div class="alert alert-success">
                                            {{ session()->get('success') }}
                                        </div>
                                    @endif
                                    <form method="POST" action="{{ route('receptionist.login_submit') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control @error('username') is-invalid @enderror"
                                                name="username" placeholder="Usuário" value="{{ old('username') }}"
                                                autofocus>
                                            @error('username')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" placeholder="Senha">
                                            @error('password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <button type="submit"
                                                class="btn btn-primary btn-lg btn-block">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    @include('receptionist.layout.scripts_footer')
</body>

</html>
