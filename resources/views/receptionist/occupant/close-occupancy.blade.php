@extends('receptionist.layout.master')

@section('title', 'Fechamento de Ocupação do Quarto')

@section('main_content')
    <div class="container mt-5">
        <h2 class="mb-4">Fechamento de Ocupação do Quarto</h2>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Dados do Quarto</h5>
                <p>Quarto: {{ $occupant->rentalUnit->number }} - Tipo: {{ $occupant->rentalUnit->type }}</p>
                @if ($occupant->transfer_date)
                    <p>Data de Transferência: {{ \Carbon\Carbon::parse($occupant->transfer_date)->format('d/m/Y') }}</p>
                    <p>Motivo da Transferência: {{ $occupant->transfer_reason }}</p>
                @endif

                <p>Data de Check-in: {{ \Carbon\Carbon::parse($occupant->check_in)->format('d/m/Y') }}</p>
                <p>Data de Check-out: {{ \Carbon\Carbon::parse($occupant->check_out)->format('d/m/Y') }}</p>
                <p>Duração Total da Estadia: {{ $stayDuration }} dias</p>
                @if ($occupant->billing_type == 'private')
                    <p>Tipo de Faturamento: Particular - Valor Devido: R$
                        {{ number_format($rentalAmountOwed, 2, ',', '.') }}</p>
                @else
                    <p>Tipo de Faturamento: Empresa - {{ $occupant->company_name }}</p>
                @endif
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Bebidas Consumíveis Compradas</h5>
                @foreach ($consumableDrinks as $drink)
                    <p>{{ $drink->name }} - Comprado em:
                        {{ \Carbon\Carbon::parse($drink->pivot->created_at)->format('d/m/Y H:i') }}</p>
                @endforeach
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Bebidas Não Pagas</h5>
                @foreach ($unpaidDrinks as $drink)
                    <p>{{ $drink->name }} - Valor: R$
                        {{ number_format($drink->price * $drink->pivot->quantity, 2, ',', '.') }}</p>
                @endforeach
                <p>Total Não Pago: R$ {{ number_format($totalUnpaid, 2, ',', '.') }}</p>
            </div>
        </div>

        @if ($occupant->billing_type == 'private')
            {{-- Show button to charge rent and close occupancy --}}
            <a href="{{ route('receptionist.occupants.chargeRent', $occupant->id) }}" class="btn btn-primary">Cobrar
                Aluguel e Fechar Ocupação</a>
        @else
            {{-- Button to simply close occupancy for company billed occupants --}}
            <a href="{{ route('receptionist.occupants.closeOccupancy', $occupant->id) }}" class="btn btn-secondary">Fechar
                Ocupação</a>
        @endif

    </div>
@endsection
