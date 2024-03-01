<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Registros de Caixa Fechados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 12px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table th {
            background-color: #007bff;
            color: #ffffff;
        }

        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Registros de Caixa Fechados</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Recepcionista</th>
                <th>Valor Inicial</th>
                <th>Valor Final</th>
                <th>Vendas Totais</th>
                <th>Valor Recebido</th>
                <th>Sangria</th>
                <th>Data de Fechamento</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($closedRecords as $record)
                <tr>
                    <td>{{ $record->receptionist->name }}</td>
                    <td>R$ {{ number_format($record->start_amount, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($record->end_amount, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($record->total_sales, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($record->total_cash_received, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($record->quantity_withdrawn ?? 0, 2, ',', '.') }}</td>
                    <td>{{ $record->closed_at ? \Carbon\Carbon::parse($record->closed_at)->format('d/m/Y H:i:s') : '' }}
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
