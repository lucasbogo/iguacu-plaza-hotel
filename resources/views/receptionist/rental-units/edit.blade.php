@extends('receptionist.layout.master')

@section('title', 'Editar Unidade de Aluguel')

@section('main_content')
    <div class="section-header">
        <h1>Editar Unidade de Aluguel</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Informações da Unidade</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('receptionist.rental-units.update', $rentalUnit->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="number">Número</label>
                                <input type="text" class="form-control" id="number" name="number"
                                    value="{{ $rentalUnit->number }}" required>
                            </div>
                            <div class="form-group">
                                <label for="type">Tipo</label>
                                <select class="form-control" id="type" name="type">
                                    <option value="single" {{ $rentalUnit->type == 'single' ? 'selected' : '' }}>Solteiro
                                    </option>
                                    <option value="double" {{ $rentalUnit->type == 'double' ? 'selected' : '' }}>Duplo
                                    </option>
                                    <option value="couple" {{ $rentalUnit->type == 'couple' ? 'selected' : '' }}>Casal
                                    </option>
                                    <option value="triple" {{ $rentalUnit->type == 'triple' ? 'selected' : '' }}>Triplo
                                    </option>
                                    <option value="quadruple" {{ $rentalUnit->type == 'quadruple' ? 'selected' : '' }}>
                                        Quádruplo</option>
                                    <option value="couple_plus_one"
                                        {{ $rentalUnit->type == 'couple_plus_one' ? 'selected' : '' }}>Casal + 1</option>
                                    <option value="couple_plus_two"
                                        {{ $rentalUnit->type == 'couple_plus_two' ? 'selected' : '' }}>Casal + 2</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="observations">Observações</label>
                                <textarea class="form-control" id="observations" name="observations" rows="3">{{ $rentalUnit->observations }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-success">Atualizar</button>
                            <a href="{{ route('receptionist.rental-units.index') }}" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
