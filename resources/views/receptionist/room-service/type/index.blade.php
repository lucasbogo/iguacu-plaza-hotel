@extends('receptionist.layout.master')

@section('title', 'Tipos de Serviço')

@section('main_content')
    <div class="section-header">
        <h1>Tipos de Serviço</h1>
        <div class="section-header-breadcrumb">
            <a href="{{ route('receptionist.service-types.create') }}" class="btn btn-success"><i class="fa fa-plus"></i>
                Adicionar Novo Tipo de Serviço</a>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Todos os Tipos de Serviço</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="serviceTypesTable">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Descrição</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($serviceTypes as $serviceType)
                                        <tr>
                                            <td>{{ $serviceType->name }}</td>
                                            <td>{{ $serviceType->description }}</td>
                                            <td>
                                                <a href="{{ route('receptionist.service-types.edit', $serviceType->id) }}"
                                                    class="btn btn-primary">Editar</a>
                                                <form
                                                    action="{{ route('receptionist.service-types.destroy', $serviceType->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Tem certeza que deseja deletar este tipo de serviço?');">Deletar</button>
                                                </form>
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
