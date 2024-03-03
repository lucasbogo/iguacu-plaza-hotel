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
    <!-- Logs Table -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Logs</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Mensagem</th>
                                    <th>Status</th>
                                    <th>Criado em</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logs as $log)
                                    <tr>
                                        <td>{!! $log->message !!}</td>
                                        <td>
                                            @switch($log->status)
                                                @case('resolved')
                                                    <span class="badge badge-success">Resolvido</span>
                                                @break

                                                @case('pending')
                                                    <span class="badge badge-warning">Pendente</span>
                                                @break

                                                @case('cannot_be_resolved')
                                                    <span class="badge badge-danger">Não pode ser resolvido</span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td>{{ $log->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <form action="{{ route('receptionist.logs.update', $log->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="status"
                                                            id="resolved{{ $log->id }}" value="resolved"
                                                            {{ $log->status == 'resolved' ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="resolved{{ $log->id }}">Resolvido</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="status"
                                                            id="pending{{ $log->id }}" value="pending"
                                                            {{ $log->status == 'pending' ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="pending{{ $log->id }}">Pendente</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="status"
                                                            id="cannot_be_resolved{{ $log->id }}"
                                                            value="cannot_be_resolved"
                                                            {{ $log->status == 'cannot_be_resolved' ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="cannot_be_resolved{{ $log->id }}">Não pode ser
                                                            resolvido</label>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-sm btn-primary">Atualizar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
