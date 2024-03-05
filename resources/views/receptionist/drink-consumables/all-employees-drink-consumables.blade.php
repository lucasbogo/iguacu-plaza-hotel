@extends('receptionist.layout.master')

@section('title', 'Bebidas por Funcionário')

@section('main_content')
    <div class="section-header">
        <h1>Bebidas por Funcionário</h1>
    </div>

    <div class="section-body">
        @forelse ($employees as $employee)
            <div class="card">
                <div class="card-header">
                    <h4>{{ $employee->name }}</h4>
                </div>
                @if ($employee->drinkConsumables->isNotEmpty())
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Bebida</th>
                                        <th>Quantidade</th>
                                        <th>Preço Unitário</th>
                                        <th>Custo Total</th>
                                        <th>Pago</th>
                                        <th>Data da Compra</th> <!-- Added column for created_at -->
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employee->drinkConsumables as $drinkConsumable)
                                        <tr>
                                            <td>{{ $drinkConsumable->name }}</td>
                                            <td>{{ $drinkConsumable->pivot->quantity }}</td>
                                            <td>R$ {{ number_format($drinkConsumable->pivot->employee_price, 2, ',', '.') }}
                                            </td>
                                            <td>R$
                                                {{ number_format($drinkConsumable->pivot->quantity * $drinkConsumable->pivot->employee_price, 2, ',', '.') }}
                                            </td>
                                            <td>{{ $drinkConsumable->pivot->paid ? 'Sim' : 'Não' }}</td>
                                            <td>{{ $drinkConsumable->pivot->created_at->format('d/m/Y H:i') }}</td>
                                            <!-- Displaying created_at -->
                                            <td>
                                                @if (!$drinkConsumable->pivot->paid)
                                                    <form
                                                        action="{{ route('receptionist.employees.markAsPaid', ['employeeId' => $employee->id, 'drinkConsumableId' => $drinkConsumable->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success">Marcar como
                                                            Pago</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <div class="card-body">
                        <div class="alert alert-info" role="alert">
                            <h4 class="alert-heading">{{ $employee->name }}</h4>
                            <p>Nenhuma bebida comprada.</p>
                        </div>
                    </div>
                @endif
            </div>
        @empty
            <div class="alert alert-warning" role="alert">
                Nenhum funcionário encontrado.
            </div>
        @endforelse
    </div>
@endsection
