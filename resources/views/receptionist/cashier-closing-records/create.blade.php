@extends('receptionist.layout.master')

@section('title', 'Novo Registro de Fechamento de Caixa')

@section('main_content')
    <div class="section-header">
        <h1>Fechamento de Caixa</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('receptionist.cashier-closing-records.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="start_amount">Valor Inicial</label>
                                <input type="text" class="form-control" name="start_amount" value="{{ $startingAmount }}"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label for="rent_income">Aluguel Cobrado</label>
                                <input type="text" class="form-control" name="rent_income"
                                    value="{{ number_format($rentIncome, 2, ',', '.') }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="drink_amount">Drinks Vendidos</label>
                                <input type="text" class="form-control" name="drink_amount"
                                    value="{{ number_format($drinkIncome, 2, ',', '.') }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="room_service_amount">Serviços de Quarto</label>
                                <input type="text" class="form-control" name="room_service_amount"
                                    value="{{ number_format($roomServiceIncome, 2, ',', '.') }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="total_cash_received">Total de Receitas (R$)</label>
                                <input type="number" class="form-control" name="total_cash_received"
                                    value="{{ number_format($drinkIncome + $roomServiceIncome, 2, ',', '.') }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="quantity_withdrawn">Quantidade Retirada</label>
                                <input type="number" name="quantity_withdrawn" id="quantity_withdrawn" class="form-control"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-warning">Fechar Caixa</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
