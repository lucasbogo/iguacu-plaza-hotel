@extends('receptionist.layout.master')

@section('title', 'Serviços dos Quartos')

@section('main_content')
    <div class="section-header">
        <h1>Serviços de Quarto</h1>
        <div class="section-header-breadcrumb">
            <a href="{{ route('receptionist.room-services.create') }}" class="btn btn-success"><i class="fa fa-plus"></i>
                Adicionar Novo Serviço</a>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Todos os Serviços</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="example1">
                                <thead>
                                    <tr>
                                        <th>Mensalista</th>
                                        <th>Tipo de Serviço</th>
                                        <th>Custo</th>
                                        <th>Data do Serviço</th>
                                        <th>Observações</th>
                                        <th>Ações</th>
                                        <th>Pagamento</th> <!-- New column header for Payment action -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roomServices as $roomService)
                                        <tr>
                                            <td>{{ $roomService->occupant->name }}</td>
                                            <td>{{ $roomService->serviceType->name }}</td>
                                            <td>R$ {{ number_format($roomService->cost, 2, ',', '.') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($roomService->service_date)->format('d/m/Y') }}
                                            </td>
                                            <td>{{ $roomService->observations }}</td>
                                            <td>
                                                <a href="{{ route('receptionist.room-services.edit', $roomService->id) }}"
                                                    class="btn btn-primary">Editar</a>
                                                <form
                                                    action="{{ route('receptionist.room-services.destroy', $roomService->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Tem certeza que deseja deletar este serviço?');">Deletar</button>
                                                </form>
                                            </td>
                                            <td>
                                                @if (!$roomService->is_paid)
                                                    <form
                                                        action="{{ route('receptionist.room-services.markAsPaid', $roomService->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="PATCH">
                                                        <button type="submit" class="btn btn-success">Marcar como
                                                            Pago</button>
                                                    </form>
                                                @else
                                                    Pago
                                                @endif
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
    </div>
@endsection
