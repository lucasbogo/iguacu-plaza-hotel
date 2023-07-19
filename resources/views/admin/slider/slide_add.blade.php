@extends('admin.layout.master')

@section('heading')
    <div>
        <img src="{{ asset('uploads/logo-hotel.png') }}" alt="Logo" alt="Logo" style="padding: 10px;"></a>
    </div>
    <h3>Adicionar Fotos 'Slides'</h3>
@endsection

@section('right_top_button')
    <a href="{{ route('admin_slider') }}" class="btn btn-primary"><i class="fa fa-eye"></i>Ver Todos</a>
@endsection

@section('main_content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin_slider_store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label class="form-label">Foto*</label>
                                        <div>
                                            <input type="file" class="form-control" name="photo">
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Titulo</label>
                                        <input type="text" class="form-control" name="heading"
                                            value="{{ old('heading') }}">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Texto</label>
                                        <textarea name="text" class="form-control h_100" cols="30" rows="10">{{ old('text') }}</textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Texto Botão</label>
                                        <input type="text" class="form-control" name="button_text"
                                            value="{{ old('button_text') }}">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Link Botão</label>
                                        <input type="text" class="form-control" name="button_url"
                                            value="{{ old('button_url') }}">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label"></label>
                                        <button type="submit" class="btn btn-primary">Enviar</button>
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
