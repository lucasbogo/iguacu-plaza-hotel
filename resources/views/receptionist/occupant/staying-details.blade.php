@extends('receptionist.layout.master')

@section('title', 'Informações do Mensalista')

@section('main_content')
    <div class="section-header">
        <h1>Informações do Mensalista</h1>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Informações Pessoais</h4>
            </div>
            <div class="card-body">
                <p>Nome: {{ $occupant->name }}</p>
                <p>RG: {{ $occupant->rg ?? 'Não informado' }}</p>
                <p>CPF: {{ $occupant->cpf ?? 'Não informado' }}</p>
                <p>Quarto Atual: {{ $occupant->rentalUnit->number }}</p>
                <p>Check-in: {{ \Carbon\Carbon::parse($occupant->check_in)->format('d/m/Y') }}</p>
                <p>Dias de Estadia Atual: {{ $currentStayDuration }}</p>
            </div>
        </div>

        @if ($occupant->roomTransfers->isNotEmpty() || isset($lastDuration))
            <div class="card">
                <div class="card-header">
                    <h4>Histórico de Transferências de Quarto</h4>
                </div>
                <div class="card-body">
                    @foreach ($transferDetails as $detail)
                        <div>
                            <p>De Quarto: {{ $detail['from_room'] ?? 'N/A' }} Para Quarto: {{ $detail['to_room'] }}</p>
                            <p>Período da Estadia: {{ $detail['duration'] }} dias</p>
                            <p>Motivo: {{ $detail['reason'] ?? 'N/A' }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        <!-- Adicione seções para DrinkConsumables, RentPayments e RoomServices conforme necessário -->
    </div>
@endsection
