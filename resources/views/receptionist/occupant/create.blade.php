@extends('receptionist.layout.master')

@section('title', 'Adicionar Novo Mensalista')

@section('main_content')
    <div class="section-header">
        <h1>Adicionar Novo Mensalista</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Informações do Mensalista</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('receptionist.occupants.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="rental_unit_id">Quarto</label>
                                <select class="form-control" id="rental_unit_id" name="rental_unit_id" required>
                                    <option value="">Selecione o Quarto</option>
                                    @foreach ($rentalUnits as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->number }} - {{ $unit->type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Nome do Mensalista</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Nome do Ocupante" required>
                            </div>
                            <div class="form-group">
                                <label for="check_in">Data de Entrada</label>
                                <input type="date" class="form-control" id="check_in" name="check_in" required>
                            </div>
                            <div class="form-group">
                                <label for="check_out">Data de Saída (opcional)</label>
                                <input type="date" class="form-control" id="check_out" name="check_out">
                            </div>
                            <div class="form-group">
                                <label for="rent_amount">Valor do Aluguel</label>
                                <input type="number" step="0.01" class="form-control" id="rent_amount"
                                    name="rent_amount" required>
                            </div>
                            <div class="form-group">
                                <label for="payment_date">Data do Pagamento</label>
                                <input type="date" class="form-control" id="payment_date" name="payment_date" required>
                            </div>
                            <button type="submit" class="btn btn-success">Salvar</button>
                            <a href="{{ route('receptionist.occupants.index') }}" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection