@extends('receptionist.layout.master')

@section('title', 'Detalhes do Ocupante')

@section('main_content')
    <div class="container">
        <h2>Detalhes do Mensalista: {{ $occupant->name }}</h2>

        <p><strong>Quarto:</strong> {{ $occupant->rentalUnit->number }}</p>
        <p><strong>Check-in:</strong> {{ \Carbon\Carbon::parse($occupant->check_in)->format('d/m/Y') }}</p>
        @if ($occupant->check_out)
            <p><strong>Check-out:</strong> {{ \Carbon\Carbon::parse($occupant->check_out)->format('d/m/Y') }}</p>
            <p><strong>Duração da estadia:</strong> {{ $stayDuration }} dias</p>
        @endif

        @if ($occupant->billing_type == 'private')
            <h3>Pagamentos de Aluguel</h3>
            <ul>
                @foreach ($occupant->rentPayments as $payment)
                    <li>{{ $payment->payment_date->format('d/m/Y') }} - R$
                        {{ number_format($payment->amount, 2, ',', '.') }}</li>
                @endforeach
            </ul>
        @else
            <p>Faturado: {{ $companyName }}</p>
        @endif

        {{-- @if ($transferDetails)
            <h3>Room Transfer Details</h3>
            <ul>
                <li>Transfer Date: {{ $transferDetails['date'] }}</li>
                <li>Reason: {{ $transferDetails['reason'] }}</li>
                <li>New Room Number: {{ $transferDetails['new_room'] }}</li>
                <!-- Display previous room number if you have that information -->
            </ul>
        @endif --}}
        
        <!-- This needs to be optmized to show the 
            history of drinks bought and paid for, 
            along with the total of all drinks bought -->
        <h3>Bebidas</h3>
        <ul>
            @foreach ($occupant->drinkConsumables as $drink)
                <li>{{ $drink->name }} - Quantidade: {{ $drink->pivot->quantity }}</li>
            @endforeach
        </ul>

        @if ($occupant->roomServices->isNotEmpty())
            <h3>Serviços de Quarto</h3>
            <ul>
                @foreach ($occupant->roomServices as $service)
                    <li>{{ $service->description }} - R$ {{ number_format($service->cost, 2, ',', '.') }}</li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
