@extends('receptionist.layout.master')

@section('heading')
    Editar Perfil
@endsection

@section('main_content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('receptionist_profile_update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="{{ asset('uploads/' . Auth::guard('receptionist')->user()->photo) }}"
                                        alt="" class="profile-photo w_100_p">
                                    <input type="file" class="form-control mt_10" name="photo">
                                </div>
                                <div class="col-md-9">
                                    <div class="mb-4">
                                        <label class="form-label">Nome</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ Auth::guard('receptionist')->user()->name }}">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Usuário</label>
                                        <input type="text" class="form-control" name="username"
                                            value="{{ Auth::guard('receptionist')->user()->username }}">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Nova Senha</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Confirmar Nova Senha</label>
                                        <input type="password" class="form-control" name="retype_password">
                                    </div>
                                    <div class="mb-4">
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
