<!DOCTYPE html>
<html>
<head>
    <title>Lista de Mensalistas</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 100px; /* Adjust based on your logo's size */
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {background-color: #f9f9f9;}
    </style>
</head>
<body>
    {{-- <div class="header">
        <img src="{{ asset('uploads/logo-hotel.png') }}" alt=""> 
        <h1>Lista de Mensalistas</h1>
    </div> --}}

    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Quarto</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Valor do Aluguel</th>
                <th>Data de Pagamento</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($occupants as $occupant)
                <tr>
                    <td>{{ $occupant->name }}</td>
                    <td>{{ $occupant->rentalUnit->number ?? 'Indisponível' }}</td>
                    <td>{{ \Carbon\Carbon::parse($occupant->check_in)->format('d/m/Y') }}</td>
                    <td>{{ $occupant->check_out ? \Carbon\Carbon::parse($occupant->check_out)->format('d/m/Y') : 'Indisponível' }}</td>
                    <td>R$ {{ number_format($occupant->rent_amount, 2, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($occupant->payment_date)->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
