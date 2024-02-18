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
                        <i class="far fa-building"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Quartos Registrados</h4>
                        </div>
                        {{-- <div class="card-body">
                            {{ $totalRoomsRegistered }}
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Hóspedes Registrados</h4>
                        </div>
                        {{-- <div class="card-body">
                            {{ $totalRenterGuests }}
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="far fa-money-bill-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Valor Total do Aluguel</h4>
                        </div>
                        {{-- <div class="card-body">
                            R$ {{ number_format($totalRentAmount, 2, ',', '.') }}
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
