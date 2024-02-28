<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Fechamento de Caixa</title>
    <style>
        /* Add your custom styles for the PDF here */
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Detalhes do Fechamento de Caixa</h1>
        </div>
        <table class="table">
            <tr>
                <th>Recepcionista</th>
                <th>Valor Inicial</th>
                <th>Valor Final</th>
                <th>Vendas Totais</th>
                <th>Valor Recebido</th>
                <th>Data de Fechamento</th>
            </tr>
            <tr>
                <td>{{ $cashierClosingRecord->receptionist->name }}</td>
                <td>R$ {{ number_format($cashierClosingRecord->start_amount, 2, ',', '.') }}</td>
                <td>R$ {{ number_format($cashierClosingRecord->end_amount, 2, ',', '.') }}</td>
                <td>R$ {{ number_format($cashierClosingRecord->total_sales, 2, ',', '.') }}</td>
                <td>R$ {{ number_format($cashierClosingRecord->total_cash_received, 2, ',', '.') }}</td>
                <td>{{ $cashierClosingRecord->closed_at ? \Carbon\Carbon::parse($cashierClosingRecord->closed_at)->format('d/m/Y H:i:s') : '' }}
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
