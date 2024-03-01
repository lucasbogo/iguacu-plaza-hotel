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
                                <!-- Trigger Modal Button -->
                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                    data-target="#buyDrinkModal-{{ $occupant->id }}">Comprar Bebida</button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="float-left">
            <a href="{{ route('receptionist.occupants.print-pdf') }}" class="btn btn-warning">
                <i class="fa fa-print"></i> Imprimir
            </a>
        </div>
        <br>

        @foreach ($occupants as $occupant)
            <!-- Modal for Buying Drink -->
            <div class="modal fade" id="buyDrinkModal-{{ $occupant->id }}" tabindex="-1" role="dialog"
                aria-labelledby="buyDrinkModalLabel-{{ $occupant->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="buyDrinkModalLabel-{{ $occupant->id }}">Compra de Bebida para
                                {{ $occupant->name }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('receptionist.occupants.buy-drink', $occupant->id) }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <!-- Example: Form field for selecting drink -->
                                <div class="form-group">
                                    <label for="drink_consumable_id-{{ $occupant->id }}">Bebida</label>
                                    <select class="form-control" id="drink_consumable_id-{{ $occupant->id }}"
                                        name="drink_consumable_id">
                                        @foreach ($drinkConsumables as $drink)
                                            <option value="{{ $drink->id }}">{{ $drink->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Quantity Input -->
                                <div class="form-group">
                                    <label for="quantity-{{ $occupant->id }}">Quantidade</label>
                                    <input type="number" class="form-control" id="quantity-{{ $occupant->id }}"
                                        name="quantity" min="1" value="1">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Confirmar Compra</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
