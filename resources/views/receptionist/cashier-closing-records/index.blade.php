@extends('receptionist.layout.master')

@section('title', 'Registros de Fechamento de Caixa')

@section('main_content')
    <div class="section-header">
        <h1>Registros de Fechamento de Caixa</h1>
        <div class="section-header-breadcrumb">
            <a href="{{ route('receptionist.cashier-closing-records.create') }}" class="btn btn-success"><i
                    class="fa fa-plus"></i> Novo Registro de Fechamento</a>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Todos os Registros</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="example1">
                                <thead>
                                    <tr>
                                        <th>Recepcionista</th>
                                        <th>Valor Inicial</th>
                                        <th>Valor Final</th>
                                        <th>Vendas Totais</th>
                                        <th>Valor Recebido</th>
                                        <th>Data de Fechamento</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($records as $record)
                                        <tr>
                                            <td>{{ $record->receptionist->name }}</td>
                                            <td>R$ {{ number_format($record->start_amount, 2, ',', '.') }}</td>
                                            <td>R$ {{ number_format($record->end_amount, 2, ',', '.') }}</td>
                                            <td>R$ {{ number_format($record->total_sales, 2, ',', '.') }}</td>
                                            <td>R$ {{ number_format($record->total_cash_received, 2, ',', '.') }}</td>
                                            <td>{{ $record->closed_at ? \Carbon\Carbon::parse($record->closed_at)->format('d/m/Y H:i:s') : '' }}
                                            </td>
                                            <td>
                                                <a href="{{ route('receptionist.cashier-closing-records.show', $record->id) }}"
                                                    class="btn btn-primary">Detalhes</a>
                                                <a href="{{ route('receptionist.cashier-closing-records.print', $record->id) }}"
                                                    class="btn btn-info">Imprimir PDF</a>
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
