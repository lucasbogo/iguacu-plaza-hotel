@extends('admin.layout.master')

@section('heading')
    Editar perfil

@section('main_content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="{{ asset('uploads/' . Auth::guard('admin')->user()->photo) }}" alt=""
                                        class="profile-photo w_100_p">
                                    <input type="file" class="form-control mt_10" name="photo">
                                </div>
                                <div class="col-md-9">
                                    <div class="mb-4">
                                        <label class="form-label">{{ Auth::guard('admin')->user()->name }}</label>
                                        <input type="text" class="form-control" name="name" value="John Doe">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">{{ Auth::guard('admin')->user()->email }}</label>
                                        <input type="text" class="form-control" name="email" value="john@gmail.com">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Senha</label>
                                        <input type="password" class="form-control" name="new_password">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Confirmar senha</label>
                                        <input type="password" class="form-control" name="retype_password">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label"></label>
                                        <button type="submit" class="btn btn-primary">Update</button>
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


@endsection
