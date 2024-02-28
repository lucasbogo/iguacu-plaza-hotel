@extends('receptionist.layout.master')

@section('title', 'Novo Registro de Fechamento de Caixa')

@section('main_content')
    <div class="section-header">
        <h1>Novo Registro de Fechamento de Caixa</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('receptionist.cashier-closing-records.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="receptionist_id">Recepcionista</label>
                                <select name="receptionist_id" id="receptionist_id" class="form-control">
                                    @foreach ($receptionists as $receptionist)
                                        <option value="{{ $receptionist->id }}">{{ $receptionist->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="start_amount">Valor Inicial</label>
                                <input type="text" name="start_amount" id="start_amount" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="end_amount">Valor Final</label>
                                <input type="text" name="end_amount" id="end_amount" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="total_sales">Vendas Totais</label>
                                <input type="text" name="total_sales" id="total_sales" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="total_cash_received">Valor Recebido</label>
                                <input type="text" name="total_cash_received" id="total_cash_received"
                                    class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
