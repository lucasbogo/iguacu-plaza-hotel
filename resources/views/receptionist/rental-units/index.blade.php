@extends('receptionist.layout.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Ocupação dos Quartos</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Ocupações Registradas</h4>
                            <div class="card-header-action">
                                <a href="{{ route('receptionist.room_occupancies.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Adicionar Ocupação
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}

    {{-- <script>
        $(document).ready(function() {
            // Add any JavaScript you need to interact with your table here.
            // Example: delete item, change status, etc.
        });
    </script> --}}
@endpush
