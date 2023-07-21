@extends('admin.layout.master')

@section('heading')
    <div>
        <img src="{{ asset('uploads/logo-hotel.png') }}" alt="Logo" style="padding: 10px;">
    </div>
    <h3>Ícones Características do Hotel</h3>
@endsection

@section('right_top_button')
    <a href="{{ route('admin_feature_add') }}" class="btn btn-primary"><i class="fa fa-plus"></i>Adicionar</a>
@endsection

@section('main_content')
    @if ($features->count() > 0)
        <!-- Check if there are features/icons in the $features array -->
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
                                            <th>Ícone</th>
                                            <th>Título</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($features as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <i class="{{ $row->icon }} fz_40"></i>
                                                </td>
                                                <td>
                                                    {{ $row->heading }}
                                                </td>
                                                <td class="pt_10 pb_10">
                                                    <a href="{{ route('admin_feature_edit', $row->id) }}"
                                                        class="btn btn-primary">Editar</a>
                                                    <a href="{{ route('admin_feature_delete', $row->id) }}"
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
    @endif
@endsection
