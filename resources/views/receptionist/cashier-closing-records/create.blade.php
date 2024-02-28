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
                                <input type="text" name="start_amount" id="start_amount" class="form-control"
                                    value="{{ $startingAmount }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="rent_amount">Aluguel Recebido</label>
                                <input type="text" name="rent_amount" id="rent_amount" class="form-control"
                                    value="{{ $rentAmount }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="drink_amount">Drinks Vendidos</label>
                                <input type="text" name="drink_amount" id="drink_amount" class="form-control"
                                    value="{{ $drinkAmount }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="room_service_amount">Serviços de Quarto</label>
                                <input type="text" name="room_service_amount" id="room_service_amount"
                                    class="form-control" value="{{ $roomServiceAmount }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="total_cash_received">Valor Recebido</label>
                                <input type="text" name="total_cash_received" id="total_cash_received"
                                    class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Fechar Caixa</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
