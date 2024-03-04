@extends('receptionist.layout.master')

@section('title', 'Consumíveis de Bebidas')

@section('main_content')
    <div class="section-header">
        <h1>Bebidas</h1>
        <div class="section-header-breadcrumb">
            <a href="{{ route('receptionist.drink-consumables.create') }}" class="btn btn-success"><i class="fa fa-plus"></i>
                Adicionar Nova Bebida</a>
        </div>
    </div>  

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Todas as Bebidas</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="example1">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Custo</th>
                                        <th>Preço para Funcionários</th> <!-- Add employee price header -->
                                        <th>Quantidade</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($drinkConsumables as $drinkConsumable)
                                        <tr>
                                            <td>{{ $drinkConsumable->name }}</td>
                                            <td>R$ {{ number_format($drinkConsumable->cost, 2, ',', '.') }}</td>
                                            <td>R$ {{ number_format($drinkConsumable->employee_price, 2, ',', '.') }}</td>
                                            <!-- Display employee price -->
                                            <td>{{ $drinkConsumable->quantity }}</td>
                                            <td>
                                                <a href="{{ route('receptionist.drink-consumables.edit', $drinkConsumable->id) }}"
                                                    class="btn btn-primary">Editar</a>
                                                <form
                                                    action="{{ route('receptionist.drink-consumables.destroy', $drinkConsumable->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Tem certeza que deseja deletar este consumível?');">Deletar</button>
                                                </form>
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
@endsection
