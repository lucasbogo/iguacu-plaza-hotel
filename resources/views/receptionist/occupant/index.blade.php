@extends('receptionist.layout.master')

@section('title', 'Gestão de Ocupantes')

@section('main_content')
    <div class="section-header">
        <h1>Gestão de Mensalistas</h1>
        <div class="section-header-breadcrumb">
            <a href="{{ route('receptionist.occupants.create') }}" class="btn btn-success">
                <i class="fa fa-plus"></i> Adicionar Novo Mensalista
            </a>
        </div>
    </div>
    <div class="float-left">
        <a href="{{ route('receptionist.occupants.print-pdf') }}" class="btn btn-info">
            <i class="fa fa-print"></i> Imprimir
        </a>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="example1">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Quarto</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Valor do Aluguel</th>
                    <th>Data de Pagamento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($occupants as $occupant)
                    <tr>
                        <td>{{ $occupant->name }}</td>
                        <td>{{ $occupant->rentalUnit->number ?? 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($occupant->check_in)->format('d/m/Y') }}</td>
                        <td>{{ $occupant->check_out ? \Carbon\Carbon::parse($occupant->check_out)->format('d/m/Y') : 'N/A' }}
                        </td>
                        <td>R$ {{ number_format($occupant->rent_amount, 2, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($occupant->payment_date)->format('d/m/Y') }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('receptionist.occupants.edit', $occupant->id) }}"
                                    class="btn btn-sm btn-primary">Editar</a>
                                <form action="{{ route('receptionist.occupants.destroy', $occupant->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Tem Certeza?');">Deletar</button>
                                </form>
                            </div>
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
