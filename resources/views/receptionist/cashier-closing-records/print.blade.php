<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Fechamento de Caixa</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 24px;
            color: #333;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            /* Ensures the table layout is fixed */
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            word-wrap: break-word;
            /* Ensures content fits within the cell */
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
    <div class="container">
        <div class="header">
            <h1>Detalhes do Fechamento de Caixa</h1>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Operador</th>
                    <th>Valor Inicial</th>
                    <th>Valor Final</th>
                    <th>Vendas Totais</th>
                    <th>Valor Recebido</th>
                    <th>Sangria</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $cashierClosingRecord->receptionist->name }}</td>
                    <td>R$ {{ number_format($cashierClosingRecord->start_amount, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($cashierClosingRecord->end_amount, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($cashierClosingRecord->total_sales, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($cashierClosingRecord->total_cash_received, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($cashierClosingRecord->quantity_withdrawn, 2, ',', '.') }}</td>
                    <td>{{ $cashierClosingRecord->closed_at ? \Carbon\Carbon::parse($cashierClosingRecord->closed_at)->format('d/m/Y H:i:s') : '' }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
