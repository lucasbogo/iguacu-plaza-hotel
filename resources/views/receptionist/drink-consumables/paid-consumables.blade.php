@extends('receptionist.layout.master')

@section('title', 'Bebidas Pagas por Mensalista')

@section('main_content')
    <style>
        /* Additional styles for improved readability */
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            border-radius: 5px;
        }

        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }

        .card-header {
            font-size: 20px;
            font-weight: bold;
            color: #007bff;
        }

        .table {
            margin-top: 20px;
        }

        .table th {
            background-color: #007bff;
            color: white;
        }

        .alert-warning {
            background-color: #ffecd1;
            border-color: #ffecd1;
            color: #856404;
        }

        .total-received {
            margin-top: 20px;
            font-size: 18px;
            text-align: right;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            margin: 10px 0;
            /* Adjust margin to position the button at the bottom */
        }

        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }
    </style>

    <div class="section-header">
        <h1>Bebidas Pagas por Mensalista</h1>
    </div>

    <div class="section-body print-area">
        @php $totalReceived = 0; @endphp
        @forelse ($occupants as $occupant)
            <div class="card">
                <div class="card-header">
                    {{ $occupant->name }}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Bebida</th>
                                    <th>Quantidade</th>
                                    <th>Custo Total</th>
                                    <th>Data da Compra</th> <!-- Added Date Column -->
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
                                        <td>{{ $drink->pivot->created_at->format('d/m/Y') }}</td> <!-- Display Date -->
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">Nenhuma bebida paga encontrada para este mensalista.</td>
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
            Total Recebido: <span>R$ {{ number_format($totalReceived, 2, ',', '.') }}</span>
        </div>
    </div>
    <div class="no-print" style="text-align: left">
        <button onclick="window.print();" class="btn btn-warning"><i class="fa fa-print"></i> Imprimir</button>
    </div>
@endsection
