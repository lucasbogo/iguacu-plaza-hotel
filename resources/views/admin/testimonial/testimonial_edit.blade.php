@extends('admin.layout.master')

@section('heading')
    <div>
        <img src="{{ asset('uploads/logo-hotel.png') }}" alt="Logo" alt="Logo" style="padding: 10px;"></a>
    </div>
    <h3>Editar Avaliações</h3>
@endsection

@section('right_top_button')
    <a href="{{ route('admin_testimonial') }}" class="btn btn-primary"><i class="fa fa-eye"></i>Ver Todos</a>
@endsection

@section('main_content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin_testimonial_update', $testimonial->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label class="form-label">Foto Original</label>
                                        <div>
                                            <img src="{{ asset('uploads/testimonial/' . $testimonial->photo) }}"
                                                alt="" class="w_200">
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Mudar Foto*</label>
                                        <div>
                                            <input type="file" class="form-control" name="photo">
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Nome</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ $testimonial->name }}">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Titulo Profissional</label>
                                        <input type="text" class="form-control" name="designation"
                                            value="{{ $testimonial->designation }}">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Comentário</label>
                                        <textarea name="comment" class="form-control h_100" cols="30" rows="10">{{ $testimonial->comment }}</textarea>
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
