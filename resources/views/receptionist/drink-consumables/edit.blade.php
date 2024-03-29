@extends('receptionist.layout.master')

@section('title', 'Editar Consumível de Bebida')

@section('main_content')
    <div class="section-header">
        <h1>Editar Bebida</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Informações</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('receptionist.drink-consumables.update', $drinkConsumable->id) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Nome/Tipo da Bebida</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $drinkConsumable->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="cost">Custo</label>
                                <input type="number" class="form-control" id="cost" name="cost"
                                    value="{{ $drinkConsumable->cost }}" step="0.01" required>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantidade</label>
                                <input type="number" class="form-control" id="quantity" name="quantity"
                                    value="{{ $drinkConsumable->quantity }}" required>
                            </div>
                            <div class="form-group">
                                <label for="employee_price">Preço para Funcionários</label>
                                <input type="number" class="form-control" id="employee_price" name="employee_price"
                                    value="{{ $drinkConsumable->employee_price }}" step="0.01" required>
                            </div>
                            <button type="submit" class="btn btn-success">Salvar Alterações</button>
                            <a href="{{ route('receptionist.drink-consumables.index') }}"
                                class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
