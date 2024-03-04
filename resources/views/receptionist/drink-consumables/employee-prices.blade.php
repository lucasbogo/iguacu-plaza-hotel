@extends('receptionist.layout.master')

@section('title', 'Preços de Bebidas para Funcionários')

@section('main_content')
    <div class="section-body">
        <h2>Gerenciar Preços de Bebidas para Funcionários</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Bebida</th>
                        <th>Preço Padrão</th>
                        <th>Preço para Funcionários</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($drinkConsumables as $drink)
                        <tr>
                            <td>{{ $drink->name }}</td>
                            <td>R$ {{ number_format($drink->cost, 2, ',', '.') }}</td>
                            <form action="{{ route('receptionist.drink-consumables.updateEmployeePrice', $drink->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <td>
                                    <input type="number" step="0.01" class="form-control" name="employee_price"
                                        value="{{ $drink->employee_price ?? $drink->cost }}">
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-primary">Atualizar</button>
                                </td>
                            </form>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
