@extends('frontend.layout.master')

@section('main_content')
    <div class="page-top">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ $global_page->signup_heading }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-4">
                    <form action="{{ route('customer_signup_submit') }}" method="post">
                        @csrf
                        <div class="login-form">
                            <div class="mb-3">
                                <label for="" class="form-label">Nome Completo</label>
                                <input type="text" class="form-control" name="name">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">E-mail</label>
                                <input type="text" class="form-control" name="email">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Senha</label>
                                <input type="password" class="form-control" name="password">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Confirmar Senha</label>
                                <input type="password" class="form-control" name="retype_password">
                                @if ($errors->has('retype_password'))
                                    <span class="text-danger">{{ $errors->first('retype_password') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary bg-website">Enviar</button>
                            </div>
                            <div class="mb-3">
                                <a href="{{ route('customer_login') }}" class="primary-color">Já tem um conta? Faça login
                                    agora</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
