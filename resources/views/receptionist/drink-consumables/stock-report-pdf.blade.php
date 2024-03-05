<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Relatório de Estoque de Bebidas</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            font-size: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
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
    </style>
</head>

<body>
    <h1 style="text-align: center;">Relatório de Estoque de Bebidas</h1>
    <table>
        <thead>
            <tr>
                <th>Bebida</th>
                <th>Quantidade Inicial</th>
                <th>Vendidas (Mensalistas)</th>
                <th>Vendidas (Funcionários)</th>
                <th>Quantidade Restante</th>
                <th>Total R$ (Mensalistas)</th>
                <th>Total R$ (Funcionários)</th>
                <th>Total R$</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($drinkConsumables as $drink)
                <tr>
                    <td>{{ $drink['name'] }}</td>
                    <td>{{ $drink['initial_quantity'] }}</td>
                    <td>{{ $drink['sold_to_occupants'] }}</td>
                    <td>{{ $drink['sold_to_employees'] }}</td>
                    <td>{{ $drink['remaining_quantity'] }}</td>
                    <td>{{ number_format($drink['total_amount_from_occupants'], 2, ',', '.') }}</td>
                    <td>{{ number_format($drink['total_amount_from_employees'], 2, ',', '.') }}</td>
                    <td>{{ number_format($drink['total_amount'], 2, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="6" style="text-align: right;"><strong>Total Geral R$:</strong></td>
                <td colspan="2">
                    <strong>{{ number_format($drinkConsumables->sum('total_amount'), 2, ',', '.') }}</strong></td>
            </tr>

        </tbody>
    </table>
</body>

</html>
