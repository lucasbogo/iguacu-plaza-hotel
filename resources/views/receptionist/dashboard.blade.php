@extends('receptionist.layout.master')

@section('heading')
    <h3>Olá {{ Auth::guard('receptionist')->user()->name }}</h3>
@endsection

@section('main_content')
    <div class="section-body">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fa fa-building"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Quartos Registrados</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalRentalUnitsRegistered }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Mensalistas Registrados</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalOccupants }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fa fa-money"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total em Alugueis</h4>
                        </div>
                        <div class="card-body">
                            R$ {{ number_format($totalRentAmount, 2, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
