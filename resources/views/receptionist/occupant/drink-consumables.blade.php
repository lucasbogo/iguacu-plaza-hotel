@extends('receptionist.layout.master')

@section('title', 'Consumíveis de Bebida por Ocupante')

@section('main_content')
    <div class="section-header">
        <h1>Bebidas Compradas por {{ $occupant->name }}</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Bebida</th>
                                <th>Quantidade</th>
                                <th>Custo Total</th>
                                <th>Pago</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($occupant->drinkConsumables as $drink)
                                <tr>
                                    <td>{{ $drink->name }}</td>
                                    <td>{{ $drink->pivot->quantity }}</td>
                                    <td>R$ {{ number_format($drink->cost * $drink->pivot->quantity, 2, ',', '.') }}</td>
                                    <td>{{ $drink->pivot->paid ? 'Sim' : 'Não' }}</td>
                                    <td>
                                        @if (!$drink->pivot->paid)
                                            <form
                                                action="{{ route('receptionist.occupants.markAsPaid', ['occupantId' => $occupant->id, 'drinkConsumableId' => $drink->id]) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success">Marcar como Pago</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
