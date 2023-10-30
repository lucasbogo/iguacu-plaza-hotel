@extends('customer.layout.master')

@section('heading')
    {{-- <div>
        <img src="{{ asset('uploads/logo-hotel.png') }}" alt="Logo" alt="Logo" style="padding: 10px;"></a>
    </div> --}}
    <h3>Olá {{Auth::guard('customer')->user()->name}}, bem-vindo ao seu painel de reservas.</h3>
@endsection

@section('main_content')
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fa fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Reservas/Pedidos</h4>
                    </div>
                    <div class="card-body">
                        12
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="fa fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Reservas/Pedidos Pendentes</h4>
                    </div>
                    <div class="card-body">
                        122
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
