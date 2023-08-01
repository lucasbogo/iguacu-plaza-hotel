@extends('admin.layout.master')

@section('heading')
    {{-- <div>
        <img src="{{ asset('uploads/logo-hotel.png') }}" alt="Logo" style="padding: 10px;">
    </div> --}}
    <h3>Imagens do Hotel</h3>
@endsection

@section('right_top_button')
    <a href="{{ route('admin_image_add') }}" class="btn btn-success"><i class="fa fa-plus"></i>Adicionar</a>
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
                                        <th>Imagem</th>
                                        <th>Legenda</th>
                                        <th>Status</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($images as $image)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ asset('uploads/image/' . $image->photo) }}" alt=""
                                                    style="width: 200px; height: 150px;">
                                            </td>
                                            <td>
                                                {{ $image->caption }}
                                            </td>
                                            <td>
                                                {{ $image->status ? 'Ativo' : 'Inativo' }}
                                            </td>
                                            <td class="pt_10 pb_10">
                                                <a href="{{ route('admin_image_edit', $image->id) }}"
                                                    class="btn btn-primary">Editar</a>
                                                <form action="{{ route('admin_image_toggle', $image->id) }}" method="post"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                        class="btn btn-{{ $image->status ? 'warning' : 'success' }}">
                                                        {{ $image->status ? 'Desativar' : 'Ativar' }}
                                                    </button>
                                                </form>
                                                <a href="{{ route('admin_image_delete', $image->id) }}"
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
