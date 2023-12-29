@extends('customer.layout.master')

@section('heading', 'Editar Perfil')

@section('main_content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('customer.customer_profile_submit') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    @php
                                        if (Auth::guard('customer')->user()->photo != '') {
                                            $customer_photo = Auth::guard('customer')->user()->photo;
                                        } else {
                                            $customer_photo = 'default.png';
                                        }
                                    @endphp
                                    <img src="{{ asset('uploads/' . $customer_photo) }}" alt=""
                                        class="profile-photo w_100_p">
                                    <input type="file" class="form-control mt_10" name="photo">
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label class="form-label">Nome *</label>
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ Auth::guard('customer')->user()->name }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label class="form-label">E-mail *</label>
                                                <input type="text" class="form-control" name="email"
                                                    value="{{ Auth::guard('customer')->user()->email }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label class="form-label">Telefone</label>
                                                <input type="text" class="form-control" name="phone"
                                                    value="{{ Auth::guard('customer')->user()->phone }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label class="form-label">País</label>
                                                <input type="text" class="form-control" name="country"
                                                    value="{{ Auth::guard('customer')->user()->country }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label class="form-label">Rua</label>
                                                <input type="text" class="form-control" name="street"
                                                    value="{{ Auth::guard('customer')->user()->street }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label class="form-label">Numero</label>
                                                <input type="text" class="form-control" name="number"
                                                    value="{{ Auth::guard('customer')->user()->number }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label class="form-label">Estado</label>
                                                <input type="text" class="form-control" name="state"
                                                    value="{{ Auth::guard('customer')->user()->state }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label class="form-label">Cidade</label>
                                                <input type="text" class="form-control" name="city"
                                                    value="{{ Auth::guard('customer')->user()->city }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label class="form-label">Cep</label>
                                                <input type="text" class="form-control" name="zip_code"
                                                    value="{{ Auth::guard('customer')->user()->zip_code }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-4">
                                                <label class="form-label">Senha</label>
                                                <input type="password" class="form-control" name="password">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-4">
                                                <label class="form-label">Redigitar Senha</label>
                                                <input type="password" class="form-control" name="retype_password">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label"></label>
                                        <button type="submit" class="btn btn-primary">Atualizar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
