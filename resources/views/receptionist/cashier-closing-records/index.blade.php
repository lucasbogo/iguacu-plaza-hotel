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
                @if ($rentAmount || $drinkAmount || $roomServiceAmount)
                    <div class="card">
                        <div class="card-header">
                            <h4>Resumo do Caixa</h4>
                        </div>
                        <div class="card-body">
                            <!-- Display total amounts received -->
                            <p>Total de Aluguel Recebido: R$ {{ number_format($rentAmount, 2, ',', '.') }}</p>
                            <p>Total de Bebidas Vendidas: R$ {{ number_format($drinkAmount, 2, ',', '.') }}</p>
                            <p>Total de Serviços de Quarto: R$ {{ number_format($roomServiceAmount, 2, ',', '.') }}</p>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-body">
                            <h4>Nenhum valor recebido até o momento.</h4>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
