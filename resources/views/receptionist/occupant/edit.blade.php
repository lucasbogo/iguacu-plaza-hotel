@extends('receptionist.layout.master')

@section('title', 'Editar Ocupante')

@section('main_content')
    <div class="section-header">
        <h1>Editar</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Informações do Mensalista</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('receptionist.occupants.update', $occupant->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="rental_unit_id">Quarto Atual</label>
                                <select class="form-control" id="rental_unit_id" name="rental_unit_id">
                                    @foreach ($rentalUnits as $unit)
                                        <option value="{{ $unit->id }}"
                                            {{ $unit->id == $occupant->rental_unit_id ? 'selected' : '' }}>
                                            {{ $unit->number }} - {{ $unit->type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $occupant->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="check_in">Data de Entrada</label>
                                <input type="date" class="form-control" id="check_in" name="check_in"
                                    value="{{ $occupant->check_in }}" required>
                            </div>
                            <div class="form-group">
                                <label for="check_out">Data de Saída</label>
                                <input type="date" class="form-control" id="check_out" name="check_out"
                                    value="{{ $occupant->check_out }}">
                            </div>
                            <div class="form-group">
                                <label for="rent_amount">Valor do Aluguel</label>
                                <input type="number" step="0.01" class="form-control" id="rent_amount"
                                    name="rent_amount" value="{{ $occupant->rent_amount }}" required>
                            </div>
                            <div class="form-group">
                                <label for="payment_date">Data do Pagamento</label>
                                <input type="date" class="form-control" id="payment_date" name="payment_date"
                                    value="{{ $occupant->payment_date }}" required>
                            </div>
                            <!-- Transfer Section -->
                            <h5>Transferência de Quarto</h5>
                            <div class="form-group">
                                <label for="new_rental_unit_id">Novo Quarto</label>
                                <select class="form-control" id="new_rental_unit_id" name="new_rental_unit_id">
                                    <option value="">Selecione um Novo Quarto</option>
                                    @foreach ($rentalUnits as $unit)
                                        @if ($unit->id != $occupant->rental_unit_id)
                                            <option value="{{ $unit->id }}">{{ $unit->number }} - {{ $unit->type }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="transfer_date">Data de Transferência</label>
                                <input type="date" class="form-control" id="transfer_date" name="transfer_date">
                            </div>
                            <div class="form-group">
                                <label for="transfer_reason">Motivo da Transferência</label>
                                <textarea class="form-control" id="transfer_reason" name="transfer_reason" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success">Atualizar</button>
                            <a href="{{ route('receptionist.occupants.index') }}" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
