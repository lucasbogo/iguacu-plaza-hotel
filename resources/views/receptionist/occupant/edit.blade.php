@extends('receptionist.layout.master')

@section('title', 'Editar')

@section('main_content')
    <div class="section-header">
        <h1>Editar</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Informações do Mensalista {{ $occupant->name }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('receptionist.occupants.update', $occupant->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <!-- Room Information Card -->
                            <div class="card mb-3">
                                <div class="card-header">Quarto Atual</div>
                                <div class="card-body">
                                    <h5 class="card-title" style="color: #007bff;">{{ $occupant->rentalUnit->number }} -
                                        @switch($occupant->rentalUnit->type)
                                            @case('single')
                                                Solteiro
                                            @break

                                            @case('double')
                                                Duplo
                                            @break

                                            @case('couple')
                                                Casal
                                            @break

                                            @case('triple')
                                                Triplo
                                            @break

                                            @case('quadruple')
                                                Quádruplo
                                            @break

                                            @case('couple_plus_one')
                                                Casal + 1
                                            @break

                                            @case('couple_plus_two')
                                                Casal + 2
                                            @break

                                            @default
                                                Não especificado
                                        @endswitch
                                    </h5>
                                </div>
                            </div>
                            <input type="hidden" name="rental_unit_id" value="{{ $occupant->rental_unit_id }}">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $occupant->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="name">RG</label>
                                <input type="text" class="form-control" id="rg" name="rg"
                                    value="{{ $occupant->rg }}">
                            </div>
                            <div class="form-group">
                                <label for="name">CPF</label>
                                <input type="text" class="form-control" id="cpf" name="cpf"
                                    value="{{ $occupant->cpf }}">
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
                            <button type="submit" class="btn btn-success">Atualizar</button>
                            <a href="{{ route('receptionist.occupants.index') }}" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
