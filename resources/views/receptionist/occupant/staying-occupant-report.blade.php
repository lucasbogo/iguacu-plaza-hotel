<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório do Mensalista</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
        }
        .section-title {
            margin-top: 20px;
            margin-bottom: 10px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Relatório de Checkout</h1>
            <h2>{{ $occupant->name }}</h2>
        </div>

        <!-- Personal Information -->
        <h3 class="section-title">Informações Pessoais</h3>
        <table>
            <tbody>
                <tr><th>Nome</th><td>{{ $occupant->name }}</td></tr>
                <tr><th>RG</th><td>{{ $occupant->rg ?? 'Não informado' }}</td></tr>
                <tr><th>CPF</th><td>{{ $occupant->cpf ?? 'Não informado' }}</td></tr>
                <tr><th>Quarto Atual</th><td>{{ $occupant->rentalUnit->number }}</td></tr>
                <tr><th>Check-in</th><td>{{ $checkIn->format('d/m/Y') }}</td></tr>
                <tr><th>Check-out</th><td>{{ $checkOut->format('d/m/Y') }}</td></tr>
                <tr><th>Duração da Estadia</th><td>{{ $stayDuration }} dias</td></tr>
            </tbody>
        </table>

        <!-- Rent Payments -->
        @if ($occupant->rentPayments->isNotEmpty())
            <h3 class="section-title">Pagamentos de Aluguel</h3>
            <table>
                <thead>
                    <tr>
                        <th>Data do Pagamento</th>
                        <th>Quantia</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($occupant->rentPayments as $payment)
                        <tr>
                            <td>{{ Carbon\Carbon::parse($payment->payment_date)->format('d/m/Y') }}</td>
                            <td>R$ {{ number_format($payment->amount, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <!-- Room Transfers -->
        @if (!empty($transferDetails))
            <h3 class="section-title">Histórico de Transferências de Quarto</h3>
            <table>
                <thead>
                    <tr>
                        <th>De Quarto</th>
                        <th>Para Quarto</th>
                        <th>Data da Transferência</th>
                        <th>Duração</th>
                        <th>Motivo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transferDetails as $detail)
                        <tr>
                            <td>{{ $detail['from_room'] }}</td>
                            <td>{{ $detail['to_room'] }}</td>
                            <td>{{ $detail['transfer_date'] }}</td>
                            <td>{{ $detail['duration'] }} dias</td>
                            <td>{{ $detail['reason'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <!-- Optionally include sections for DrinkConsumables and RoomServices -->

    </div>
</body>
</html>
