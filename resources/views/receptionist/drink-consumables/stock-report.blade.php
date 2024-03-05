@extends('receptionist.layout.master')

@section('title', 'Relatório de Estoque de Bebidas')

@section('main_content')
    <div class="section-header">
        <h1>Relatório de Estoque de Bebidas</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        @php
                            $timestamp = \Carbon\Carbon::now(new \DateTimeZone('America/Sao_Paulo'))->format(
                                'd/m/Y H:i:s',
                            );
                        @endphp
                        <h4 class="text-white">Detalhes do Estoque - {{ $timestamp }}</h4>
                        <a href="{{ route('receptionist.drink-consumables.stock-report.print') }}"
                            class="btn btn-light">Imprimir Relatório</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Bebida</th>
                                        <th>Quantidade Inicial</th>
                                        <th>Vendidas (Mensalistas)</th>
                                        <th>Vendidas (Funcionários)</th>
                                        <th>Quantidade Restante</th>
                                        <th>Total R$ (Mensalistas)</th>
                                        <th>Total R$ (Funcionários)</th>
                                        <th>Total R$</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($drinkConsumables as $drink)
                                        <tr>
                                            <td>{{ $drink['name'] }}</td>
                                            <td>{{ $drink['initial_quantity'] }}</td>
                                            <td>{{ $drink['sold_to_occupants'] }}</td>
                                            <td>{{ $drink['sold_to_employees'] }}</td>
                                            <td>{{ $drink['remaining_quantity'] }}</td>
                                            <td>{{ number_format($drink['total_amount_from_occupants'], 2, ',', '.') }}</td>
                                            <td>{{ number_format($drink['total_amount_from_employees'], 2, ',', '.') }}</td>
                                            <td>{{ number_format($drink['total_amount'], 2, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="6" style="text-align: right;"><strong>Total Geral R$:</strong></td>
                                        <td colspan="2">
                                            <strong>{{ number_format($drinkConsumables->sum('total_amount'), 2, ',', '.') }}</strong>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        @media print {
            .btn {
                display: none;
                /* Hide the print button when printing */
            }
        }
    </style>
@endpush
