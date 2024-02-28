@extends('receptionist.layout.master')

@section('title', 'Detalhes do Fechamento de Caixa')

@section('main_content')
    <div class="section-header">
        <h1>Detalhes do Fechamento de Caixa</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Informações do Registro</h4>
            </div>
            <div class="card-body">
                <ul>
                    <li><strong>Recepcionista:</strong> {{ $cashierClosingRecord->receptionist->name }}</li>
                    <li><strong>Valor Inicial:</strong> R$
                        {{ number_format($cashierClosingRecord->start_amount, 2, ',', '.') }}</li>
                    <li><strong>Valor Final:</strong> R$ {{ number_format($cashierClosingRecord->end_amount, 2, ',', '.') }}
                    </li>
                    <li><strong>Vendas Totais:</strong> R$
                        {{ number_format($cashierClosingRecord->total_sales, 2, ',', '.') }}</li>
                    <li><strong>Valor Recebido:</strong> R$
                        {{ number_format($cashierClosingRecord->total_cash_received, 2, ',', '.') }}</li>
                    <li><strong>Data de Fechamento:</strong>
                        {{ $cashierClosingRecord->closed_at ? \Carbon\Carbon::parse($cashierClosingRecord->closed_at)->format('d/m/Y H:i:s') : '' }}
                    </li>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
