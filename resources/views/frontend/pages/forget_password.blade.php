@extends('frontend.layout.master')

@section('main_content')
    <div class="page-top">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ $global_page->forget_password_heading }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-4">
                    <form action="{{ route('customer_forget_password_submit') }}" method="post">
                        @csrf
                        <div class="login-form">
                            <div class="mb-3">
                                <label for="" class="form-label">E-mail</label>
                                <input type="text" class="form-control" name="email">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary bg-website te">Enviar</button>
                                <a href="{{ route('customer_login') }}" class="primary-color">Retornar para o Login.</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
