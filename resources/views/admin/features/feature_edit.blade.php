@extends('admin.layout.master')

@section('heading')
    <div>
        <img src="{{ asset('uploads/logo-hotel.png') }}" alt="Logo" alt="Logo" style="padding: 10px;"></a>
    </div>
    <h3>Editar Fotos 'Slides'</h3>
@endsection

@section('right_top_button')
    <a href="{{ route('admin_feature') }}" class="btn btn-primary"><i class="fa fa-eye"></i>Ver Todos</a>
@endsection

@section('main_content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin_feature_update', $feature->id) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label class="form-label">ìcone</label>
                                        <input type="text" class="form-control" name="icon"
                                            value="{{ $feature->icon }}">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Titulo</label>
                                        <input type="text" class="form-control" name="heading"
                                            value="{{ $feature->heading }}">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Texto</label>
                                        <textarea name="text" class="form-control h_100" cols="30" rows="10">{{ $feature->text }}</textarea>
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
