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

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Mensalistas</h4>
                        <div class="float-right">
                            <input type="text" id="occupantSearchInput" onkeyup="searchOccupantTable()"
                                placeholder="Buscar por nome..." class="form-control">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="overflow-x:auto;">
                            <table class="table table-bordered" id="occupantTable">
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
                                                    <a href="{{ route('receptionist.occupants.print-pdf') }}"
                                                        class="btn btn-sm btn-info">Imprimir PDF</a>
                                                    <form
                                                        action="{{ route('receptionist.occupants.destroy', $occupant->id) }}"
                                                        method="POST" style="display:inline;">
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
    </div>
    @push('scripts')
        <script>
            function searchOccupantTable() {
                var input, filter, table, tr, td, txtValue;
                input = document.getElementById("occupantSearchInput");
                filter = input.value.toUpperCase();
                table = document.getElementById("occupantTable"); // Ensure your table has this ID
                tr = table.getElementsByTagName("tr");

                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[1]; // Assuming the name is in the second column (index 1)
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }
        </script>
    @endpush
@endsection
