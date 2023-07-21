@extends('admin.layout.master')

@section('heading')
    {{-- <div>
        <img src="{{ asset('uploads/logo-hotel.png') }}" alt="Logo" alt="Logo" style="padding: 10px;"></a>
    </div> --}}
    <h3>Avaliações</h3>
@endsection

@section('right_top_button')
    <a href="{{ route('admin_testimonial_add') }}" class="btn btn-success"><i class="fa fa-plus"></i>Adicionar</a>
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
                                        <th>Nome</th>
                                        <th>Titulo Profissional</th>
                                        <th>Comentário</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($testimonials as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ asset('uploads/testimonial/' . $row->photo) }}" alt=""
                                                    style="width: 200px; height: 150px;">
                                            </td>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->designation }}</td>
                                            <td>{{ $row->comment }}</td>

                                            <td class="pt_10 pb_10">
                                                <a href="{{ route('admin_testimonial_edit', $row->id) }}"
                                                    class="btn btn-primary">Editar</a>
                                                <a href="{{ route('admin_testimonial_delete', $row->id) }}"
                                                    class="btn btn-danger"
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
