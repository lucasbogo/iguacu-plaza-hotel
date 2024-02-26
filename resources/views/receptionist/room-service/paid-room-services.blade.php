@extends('receptionist.layout.master')

@section('title', 'Serviços de Quarto Pagos')

@section('main_content')
    <div class="section-header">
        <h1>Serviços de Quarto Pagos</h1>
    </div>

    <div class="section-body">
        @forelse ($roomServices as $service)
            @if ($service->is_paid)
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $service->occupant->name }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tipo de Serviço</th>
                                        <th>Custo</th>
                                        <th>Data do Serviço</th>
                                        <th>Observações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $service->serviceType->name }}</td>
                                        <td>R$ {{ number_format($service->cost, 2, ',', '.') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($service->service_date)->format('d/m/Y') }}</td>
                                        <td>{{ $service->observations }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        @empty
            <div class="alert alert-warning" role="alert">
                Nenhum serviço pago encontrado.
            </div>
        @endforelse
    </div>
@endsection
