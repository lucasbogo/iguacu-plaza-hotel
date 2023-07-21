@extends('admin.layout.master')

@section('heading')
    <div>
        <img src="{{ asset('uploads/logo-hotel.png') }}" alt="Logo" alt="Logo" style="padding: 10px;"></a>
    </div>
    <h3>Blog</h3>
@endsection

@section('right_top_button')
    <a href="{{ route('admin_blog_add') }}" class="btn btn-primary"><i class="fa fa-plus"></i>Adicionar</a>
@endsection

@section('main_content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="example1">
                                <thead>
                                    <tr>
                                        <th>Referencia</th>
                                        <th>Foto</th>
                                        <th>Titulo</th>
                                        <th>Autor</th>
                                        <th>Descrição Curta</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($blogs as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ asset('uploads/blog/' . $row->photo) }}" alt=""
                                                    class="w_200">
                                            </td>
                                            <td>{{ $row->title }}</td>
                                            <td>{{ $row->author }}</td>
                                            <td>{{ $row->short_content }}</td>
                                            <td class="pt_10 pb_10">
                                                <a href="{{ route('admin_blog_edit', $row->id) }}"
                                                    class="btn btn-primary">Editar</a>
                                                <a href="{{ route('admin_blog_delete', $row->id) }}" class="btn btn-danger"
                                                    onClick="return confirm('Tem Certeza?');">Deletar</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
