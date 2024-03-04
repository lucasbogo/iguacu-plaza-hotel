@extends('receptionist.layout.master')

@section('title', 'Bebidas Pagas por Funcionários')

@section('main_content')
    <div class="section-header">
        <h1>Bebidas Pagas por Funcionários</h1>
    </div>

    <div class="section-body">
        @php $totalReceived = 0; @endphp
        @forelse ($employees as $employee)
            <div class="card">
                <div class="card-header">
                    {{ $employee->name }}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Bebida</th>
                                    <th>Quantidade</th>
                                    <th>Custo Total</th>
                                    <th>Data da Compra</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($employee->drinkConsumables as $drink)
                                    @php
                                        $drinkTotal = $drink->employee_price * $drink->pivot->quantity;
                                        $totalReceived += $drinkTotal;
                                    @endphp
                                    <tr>
                                        <td>{{ $drink->name }}</td>
                                        <td>{{ $drink->pivot->quantity }}</td>
                                        <td>R$ {{ number_format($drinkTotal, 2, ',', '.') }}</td>
                                        <td>{{ $drink->pivot->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">Nenhuma bebida paga encontrada para este funcionário.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-primary">
                Nenhum funcionário com bebidas pagas encontrado.
            </div>
        @endforelse
        <div class="total-received">
            Total Recebido: <span>R$ {{ number_format($totalReceived, 2, ',', '.') }}</span>
        </div>
    </div>
    <div style="text-align: left">
        <button onclick="window.print();" class="btn btn-warning"><i class="fa fa-print"></i> Imprimir</button>
    </div>
@endsection
