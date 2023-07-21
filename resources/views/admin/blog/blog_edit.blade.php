@extends('admin.layout.master')

@section('heading')
    <div>
        <img src="{{ asset('uploads/logo-hotel.png') }}" alt="Logo" style="padding: 10px;">
    </div>
    <h3>Editar Blog</h3>
@endsection

@section('right_top_button')
    <a href="{{ route('admin_blog') }}" class="btn btn-primary"><i class="fa fa-eye"></i>Ver Todos</a>
@endsection

@section('main_content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin_blog_update', $blog->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label class="form-label">Foto Original</label>
                                        <div>
                                            <img src="{{ asset('uploads/blog/' . $blog->photo) }}" alt=""
                                                class="w_200">
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Mudar Foto*</label>
                                        <div>
                                            <input type="file" class="form-control" name="photo">
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Título</label>
                                        <input type="text" class="form-control" name="title"
                                            value="{{ $blog->title }}">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Autor</label>
                                        <input type="text" class="form-control" name="author"
                                            value="{{ $blog->author }}">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Resumo</label>
                                        <textarea name="short_content" class="form-control h_100" cols="30" rows="10">{{ $blog->short_content }}</textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Texto</label>
                                        <textarea name="content" class="form-control snote" cols="30" rows="10">{{ $blog->content }}</textarea>
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
