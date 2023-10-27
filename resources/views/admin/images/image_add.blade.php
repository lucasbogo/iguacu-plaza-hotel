@extends('admin.layout.master')

@section('heading')
    {{-- <div>
        <img src="{{ asset('uploads/logo-hotel.png') }}" alt="Logo" alt="Logo" style="padding: 10px;"></a>
    </div> --}}
    <h3>Adicionar Imagens</h3>
@endsection

@section('right_top_button')
    <a href="{{ route('admin_image') }}" class="btn btn-primary"><i class="fa fa-eye"></i>Ver Todos</a>
@endsection

@section('main_content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin_image_store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label class="form-label">Foto *</label>
                                        <input type="file" class="form-control" name="photo">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Legenda</label>
                                        <input type="text" class="form-control" name="caption"
                                            value="{{ old('caption') }}">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label"></label>
                                        <button type="submit" class="btn btn-success">Enviar</button>
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
