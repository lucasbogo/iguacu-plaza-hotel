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
                @if ($drinkIncome == 0 && $roomServiceIncome == 0)
                    <div class="alert alert-info" role="alert">
                        <h4 class="alert-heading">Ainda não há registros!</h4>
                        <p>Nenhum registro de receita foi feito ainda. Assim que os registros de bebidas vendidas e serviços
                            de quarto pagos forem feitos, eles aparecerão aqui.</p>
                    </div>
                @else
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            @php
                                $timestamp = \Carbon\Carbon::now(new \DateTimeZone('America/Sao_Paulo'))->format(
                                    'd/m/Y H:i:s',
                                );
                            @endphp
                            <h4 class="text-white">Resumo do Caixa - {{ $timestamp }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Tipo de Receita</th>
                                            <th>Valor (R$)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Bebidas Vendidas</td>
                                            <td>{{ number_format($drinkIncome, 2, ',', '.') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Serviços de Quarto Pagos</td>
                                            <td>{{ number_format($roomServiceIncome, 2, ',', '.') }}</td>
                                        </tr>
                                        <tr class="table-success">
                                            <td><strong>Total de Receitas</strong></td>
                                            <td><strong>{{ number_format($drinkIncome + $roomServiceIncome, 2, ',', '.') }}</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
