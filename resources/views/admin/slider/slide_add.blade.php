@extends('admin.layout.master')

@section('heading')
    {{-- <div>
        <img src="{{ asset('uploads/logo-hotel.png') }}" alt="Logo" alt="Logo" style="padding: 10px;"></a>
    </div> --}}
    <h3>Adicionar Slides</h3>
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
                        <form action="{{ route('admin_slider_store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="photo">Foto:</label>
                                <input type="file" name="photo" id="photo" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="heading">Heading:</label>
                                <input type="text" name="heading" id="heading" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="text">Text:</label>
                                <textarea name="text" id="text" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="button_text">Button Text:</label>
                                <input type="text" name="button_text" id="button_text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="button_url">Button URL:</label>
                                <input type="text" name="button_url" id="button_url" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <input type="checkbox" name="status" id="status" value="1" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Adicionar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
