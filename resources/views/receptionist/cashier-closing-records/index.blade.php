@extends('receptionist.layout.master')

@section('title', 'Caixa de ' . Auth::user()->name)

@section('main_content')
    <div class="section-header">
        <h1>Caixa de {{ Auth::user()->name }}</h1>
        <div class="section-header-breadcrumb">
            <a href="{{ route('receptionist.cashier-closing-records.create') }}" class="btn btn-success"><i
                    class="fa fa-plus"></i> Fechar Caixa</a>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Resumo do Caixa</h4>
                    </div>
                    <div class="card-body">
                        <p>Total de Bebidas Vendidas: R$ {{ number_format($drinkIncome, 2, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
