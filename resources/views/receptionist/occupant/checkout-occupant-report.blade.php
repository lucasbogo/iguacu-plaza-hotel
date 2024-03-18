<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Mensalista - Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            padding: 20px;
        }

        h1,
        h2,
        h3 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .summary-table th,
        .summary-table td {
            border: none;
        }

        .summary-table td {
            padding-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Relatório de Checkout do Mensalista</h1>
        <h2>Informações Gerais</h2>
        <table class="summary-table">
            <tbody>
                <tr>
                    <td><strong>Nome:</strong> {{ $occupant->name }}</td>
                </tr>
                <tr>
                    <td><strong>RG:</strong> {{ $occupant->rg ?? 'Não informado' }}</td>
                </tr>
                <tr>
                    <td><strong>CPF:</strong> {{ $occupant->cpf ?? 'Não informado' }}</td>
                </tr>
                <tr>
                    <td><strong>Quarto Atual:</strong> {{ $occupant->rentalUnit->number }}</td>
                </tr>
                <tr>
                    <td><strong>Check-in:</strong> {{ \Carbon\Carbon::parse($occupant->check_in)->format('d/m/Y') }}
                    </td>
                </tr>
                <tr>
                    <td><strong>Check-out:</strong> {{ \Carbon\Carbon::parse($occupant->check_out)->format('d/m/Y') }}
                    </td>
                </tr>
                <tr>
                    <td><strong>Duração da estadia:</strong> {{ $stayDuration }} dias</td>
                </tr>
            </tbody>
        </table>

        @if (!empty($transferDetails))
            <h2>Histórico de Transferências de Quarto</h2>
            <table>
                <thead>
                    <tr>
                        <th>De Quarto</th>
                        <th>Para Quarto</th>
                        <th>Data da Transferência</th>
                        <th>Período da Estadia (dias)</th>
                        <th>Motivo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transferDetails as $detail)
                        <tr>
                            <td>{{ $detail['from_room'] }}</td>
                            <td>{{ $detail['to_room'] }}</td>
                            <td>{{ $detail['transfer_date'] }}</td>
                            <td>{{ $detail['duration'] }}</td>
                            <td>{{ $detail['reason'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <!-- Sections for DrinkConsumables, RentPayments, and RoomServices can be added here following a similar structure -->
    </div>
</body>

</html>
