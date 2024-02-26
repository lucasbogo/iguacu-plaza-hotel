@extends('receptionist.layout.master')

@section('title', 'Serviços de Quarto não Pagos')

@section('main_content')
    <div class="section-header">
        <h1>Serviços de Quarto não Pagos</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                @if ($roomServices->where('is_paid', false)->count() > 0)
                    <div class="card">
                        <div class="card-header">
                            <h4>Serviços Pendentes</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Mensalista</th>
                                            <th>Tipo de Serviço</th>
                                            <th>Custo</th>
                                            <th>Data do Serviço</th>
                                            <th>Observações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roomServices as $roomService)
                                            @unless ($roomService->is_paid)
                                                <tr>
                                                    <td>{{ $roomService->occupant->name }}</td>
                                                    <td>{{ $roomService->serviceType->name }}</td>
                                                    <td>R$ {{ number_format($roomService->cost, 2, ',', '.') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($roomService->service_date)->format('d/m/Y') }}
                                                    </td>
                                                    <td>{{ $roomService->observations }}</td>
                                                </tr>
                                            @endunless
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-body text-center">
                            <h4>Todos os serviços de quarto foram pagos.</h4>
                            <p>Não há serviços pendentes no momento.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
