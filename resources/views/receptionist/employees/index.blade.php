@extends('receptionist.layout.master')

@section('title', 'Funcionários')

@section('main_content')
    <div class="section-header">
        <h1>Funcionários</h1>
        <div class="section-header-breadcrumb">
            <a href="{{ route('receptionist.employees.create') }}" class="btn btn-success"><i class="fa fa-plus"></i>Adicionar
                Novo Funcionário</a>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Lista de Funcionários</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Cargo</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr>
                                            <td>{{ $employee->name }}</td>
                                            <td>{{ $employee->position }}</td>
                                            <td>
                                                <a href="{{ route('receptionist.employees.edit', $employee->id) }}"
                                                    class="btn btn-sm btn-primary">Editar</a>
                                                <form action="{{ route('receptionist.employees.destroy', $employee->id) }}"
                                                    method="POST" onsubmit="return confirm('Tem certeza?');"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                                                </form>
                                                <!-- Trigger Modal Button -->
                                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                                    data-target="#buyDrinkModal-{{ $employee->id }}">Comprar Bebida</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($employees as $employee)
        <!-- Modal for Buying Drink -->
        <div class="modal fade" id="buyDrinkModal-{{ $employee->id }}" tabindex="-1" role="dialog"
            aria-labelledby="buyDrinkModalLabel-{{ $employee->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="buyDrinkModalLabel-{{ $employee->id }}">Compra de Bebida para
                            {{ $employee->name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('receptionist.employees.buy-drink', $employee->id) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <!-- Example: Form field for selecting drink -->
                            <div class="form-group">
                                <label for="drink_consumable_id-{{ $employee->id }}">Bebida</label>
                                <select class="form-control" id="drink_consumable_id-{{ $employee->id }}"
                                    name="drink_consumable_id">
                                    @foreach ($drinkConsumables as $drink)
                                        <option value="{{ $drink->id }}">{{ $drink->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Quantity Input -->
                            <div class="form-group">
                                <label for="quantity-{{ $employee->id }}">Quantidade</label>
                                <input type="number" class="form-control" id="quantity-{{ $employee->id }}"
                                    name="quantity" min="1" value="1">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Confirmar Compra</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
