<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Fechamento de Caixa</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }

        .container {
            margin: 20px auto;
            width: 95%;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header h1 {
            font-size: 22px;
            color: #0275d8;
            margin: 0;
        }

        .header p {
            font-size: 16px;
            color: #666;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 14px;
        }

        .table th {
            background-color: #0275d8;
            color: #ffffff;
            font-size: 16px;
        }

        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table-footer {
            font-weight: bold;
            background-color: #ddd;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Detalhes do Fechamento de Caixa</h1>
            <p>Data do Fechamento:
                {{ $cashierClosingRecord->closed_at ? \Carbon\Carbon::parse($cashierClosingRecord->closed_at)->format('d/m/Y H:i:s') : 'N/A' }}
            </p>

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
                    <td>Operador:</td>
                    <td>{{ $cashierClosingRecord->receptionist->name }}</td>
                </tr>
                <tr>
                    <td>Valor Inicial:</td>
                    <td>R$ {{ number_format($cashierClosingRecord->start_amount, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Valor Final:</td>
                    <td>R$ {{ number_format($cashierClosingRecord->end_amount, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Vendas Totais:</td>
                    <td>R$ {{ number_format($cashierClosingRecord->total_sales, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Valor Recebido:</td>
                    <td>R$ {{ number_format($cashierClosingRecord->total_cash_received, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Sangria:</td>
                    <td>R$ {{ number_format($cashierClosingRecord->quantity_withdrawn, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Receita de Bebidas:</td>
                    <td>R$ {{ number_format($drinkIncome, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Receita de Serviços de Quarto:</td>
                    <td>R$ {{ number_format($roomServiceIncome, 2, ',', '.') }}</td>
                </tr>

                <tr class="table-footer">
                    <td>Total de Receitas:</td>
                    <td>R$ {{ number_format($totalAmount, 2, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
