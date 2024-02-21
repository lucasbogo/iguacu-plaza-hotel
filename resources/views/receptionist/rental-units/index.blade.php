@extends('receptionist.layout.master')

@section('title', 'Gestão de Unidades de Aluguel')

@section('main_content')
    <div class="section-header">
        <h1>Gestão de Unidades de Aluguel</h1>
        <div class="section-header-breadcrumb">
            <a href="{{ route('receptionist.rental-units.create') }}" class="btn btn-success"><i class="fa fa-plus"></i>
                Adicionar Nova Unidade</a>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Todos os quartos (mensalista)</h4>
                        <!-- Search bar -->
                        <div class="float-right">
                            <input type="text" id="searchInput" onkeyup="searchTable()"
                                placeholder="Buscar por quarto..." class="form-control">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="rentalUnitsTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Número</th>
                                        <th>Tipo</th>
                                        <th>Status</th>
                                        <th>Observações</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rentalUnits as $rentalUnit)
                                        <tr>
                                            <td>{{ $rentalUnit->id }}</td>
                                            <td>{{ $rentalUnit->number }}</td>
                                            <td>{{ $rentalUnit->type }}</td>
                                            <td>
                                                @switch($rentalUnit->status)
                                                    @case('available')
                                                        Disponível
                                                    @break

                                                    @case('occupied')
                                                        Ocupado
                                                    @break

                                                    @case('maintenance')
                                                        Manutenção
                                                    @break

                                                    @case('housekeeping')
                                                        Limpeza
                                                    @break
                                                @endswitch
                                            </td>
                                            <td>{{ $rentalUnit->observations }}</td>
                                            <td>
                                                <a href="{{ route('receptionist.rental-units.edit', $rentalUnit->id) }}"
                                                    class="btn btn-primary">Editar</a>
                                                <form
                                                    action="{{ route('receptionist.rental-units.destroy', $rentalUnit->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Tem Certeza?');">Deletar</button>
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
    </div>
@endsection

@push('scripts')
    <script>
        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("rentalUnitsTable");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td");
                for (j = 0; j < td.length; j++) {
                    if (td[j]) {
                        txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                            break;
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }
        }
    </script>
@endpush
