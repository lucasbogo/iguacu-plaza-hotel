@extends('admin.layout.master')

@section('heading')
    <h3>Comodidades</h3>
@endsection

@section('right_top_button')
    <a href="{{ route('admin_amenity_add') }}" class="btn btn-success"><i class="fa fa-plus"></i>Adicionar</a>
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
                                        {{-- <th>Referencia</th> --}}
                                        <th>Nome</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($amenities as $row)
                                        <tr>
                                            {{-- <td>{{ $loop->iteration }}</td> --}}
                                            <td>
                                                {{ $row->name }}
                                            </td>
                                            <td class="pt_10 pb_10">
                                                <a href="{{ route('admin_amenity_edit', $row->id) }}"
                                                    class="btn btn-primary">Editar</a>
                                                <form action="{{ route('admin_amenity_activate', $row->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    <!-- Add a hidden input field to specify the HTTP method as PUT -->
                                                    <input type="hidden" name="_method" value="PUT">
                                                    <button type="submit"
                                                        class="btn btn-{{ $row->status ? 'warning' : 'success' }}">
                                                        {{ $row->status ? 'Desativar' : 'Ativar' }}
                                                    </button>
                                                </form>

                                                <a href="{{ route('admin_amenity_delete', $row->id) }}"
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
