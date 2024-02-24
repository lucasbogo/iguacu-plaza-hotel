@extends('receptionist.layout.master')

@section('title', 'Bebidas Pagas por Mensalista')

@section('main_content')
    <style>
        @media print {

            .no-print,
            .no-print * {
                display: none !important;
            }

            .print-only,
            .print-only * {
                display: block !important;
            }

            body,
            html {
                visibility: hidden;
                height: 0;
                overflow: hidden;
            }

            .print-area,
            .print-area * {
                visibility: visible;
            }

            .print-area {
                position: absolute;
                left: 0;
                top: 0;
                right: 0;
                height: auto;
                margin: 0;
                padding: 15px;
                overflow: visible;
            }
        }

    </style>

    <div class="no-print">
        <div class="section-header">
            <h1>Bebidas Pagas por Mensalista</h1>
        </div>
        <button onclick="window.print();" class="btn btn-info"><i class="fa fa-print"></i> Imprimir</button>
    </div>

    <div class="section-body print-area">
        @php $totalReceived = 0; @endphp
        @forelse ($occupants as $occupant)
            <div class="card">
                <div class="card-header">
                    <h4>{{ $occupant->name }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Bebida</th>
                                    <th>Quantidade</th>
                                    <th>Custo Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($occupant->drinkConsumables as $drink)
                                    @php
                                        $drinkTotal = $drink->cost * $drink->pivot->quantity;
                                        $totalReceived += $drinkTotal;
                                    @endphp
                                    <tr>
                                        <td>{{ $drink->name }}</td>
                                        <td>{{ $drink->pivot->quantity }}</td>
                                        <td>R$ {{ number_format($drinkTotal, 2, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">Nenhuma bebida paga encontrada para este mensalista.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-warning">
                Nenhum mensalista com bebidas pagas encontrado.
            </div>
        @endforelse
        <div class="total-received">
            <strong style="color: black;">Total Recebido: <span style="color: red; font-weight: bold;">R$ {{ number_format($totalReceived, 2, ',', '.') }}</span></strong>
        </div>        
    </div>
@endsection
