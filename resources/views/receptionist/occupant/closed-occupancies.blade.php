@extends('receptionist.layout.master')

@section('title', 'Ocupações Fechadas')

@section('main_content')
    <div class="section-header">
        <h1>Ocupações Fechadas</h1>
        <div class="section-header-breadcrumb">
            <a href="{{ route('receptionist.occupants.index') }}" class="btn btn-primary">
                <i class="fa fa-arrow-left"></i> Voltar para a lista de mensalistas
            </a>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Lista de Ocupações Fechadas</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="example1">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Check-in</th>
                                    <th>Check-out</th>
                                    <th>Duração da Estadia (dias)</th>
                                    <th>Tipo de Faturamento</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($closedOccupancies as $occupant)
                                    <tr>
                                        <td>{{ $occupant->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($occupant->check_in)->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($occupant->check_out)->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($occupant->check_in)->diffInDays(\Carbon\Carbon::parse($occupant->check_out)) }}
                                        </td>
                                        <td>{{ $occupant->billing_type == 'private' ? 'Particular' : 'Empresa' }}</td>
                                        <td>
                                            <a href="{{ route('receptionist.occupants.details', $occupant->id) }}"
                                                class="btn btn-info">Detalhes</a>
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
@endsection
