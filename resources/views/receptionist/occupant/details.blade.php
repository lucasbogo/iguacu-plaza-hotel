@extends('receptionist.layout.master')

@section('title', 'Detalhes do Ocupante')

@section('main_content')
    <div class="container my-4">
        <div class="card">
            <div class="card-header">
                <h2>Detalhes do Mensalista: {{ $occupant->name }}</h2>
            </div>
            <div class="card-body">
                <h3>Informações</h3>
                <p><strong>Quarto:</strong> {{ $occupant->rentalUnit->number }}</p>
                <p><strong>Check-in:</strong> {{ \Carbon\Carbon::parse($occupant->check_in)->format('d/m/Y') }}</p>
                <p><strong>Check-out:</strong> {{ \Carbon\Carbon::parse($occupant->check_out)->format('d/m/Y') }}</p>
                <p><strong>Duração da estadia:</strong> {{ $stayDuration }} dias</p>

                @if ($occupant->billing_type == 'private')
                    <h3>Pagamentos de Aluguel</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Data do Pagamento</th>
                                <th>Quantia</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($occupant->rentPayments as $payment)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d/m/Y') }}</td>
                                    <td>R$ {{ number_format($payment->amount, 2, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p><strong>Faturado:</strong> {{ $companyName }}</p>
                @endif

                @if ($occupant->roomTransfers->isNotEmpty())
                    <h3>Histórico de Transferências</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>De Quarto</th>
                                <th>Para Quarto</th>
                                <th>Data da Transferência</th>
                                <th>Motivo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($occupant->roomTransfers as $transfer)
                                <tr>
                                    <td>{{ $transfer->oldRentalUnit->number ?? 'N/A' }}</td>
                                    <td>{{ $transfer->newRentalUnit->number }}</td>
                                    <td>{{ \Carbon\Carbon::parse($transfer->transfer_date)->format('d/m/Y') }}</td>
                                    <td>{{ $transfer->transfer_reason }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                <!-- Code for DrinkConsumables goes here -->

                @if ($occupant->roomServices->isNotEmpty())
                    <h3>Serviços de Quarto</h3>
                    <ul>
                        @foreach ($occupant->roomServices as $service)
                            <li>{{ $service->description }} - R$ {{ number_format($service->cost, 2, ',', '.') }}</li>
                        @endforeach
                    </ul>
                @endif

                <!-- Button to generate report -->
                <div class="my-3">
                    <a href="{{ route('receptionist.occupants.generate-checkout-report', $occupant->id) }}"
                        class="btn btn-primary">Gerar Relatório</a>
                </div>
            </div>
        </div>
    </div>
@endsection
