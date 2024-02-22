@extends('receptionist.layout.master')

@section('title', 'Editar Serviço de Quarto')

@section('main_content')
    <div class="section-header">
        <h1>Editar Serviço de Quarto</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Informações do Serviço</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('receptionist.room-services.update', $roomService->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="occupant_id">Mensalista</label>
                                <select class="form-control" id="occupant_id" name="occupant_id" required>
                                    <option value="">Selecione um Ocupante</option>
                                    @foreach ($occupants as $occupant)
                                        <option value="{{ $occupant->id }}"
                                            {{ $occupant->id == $roomService->occupant_id ? 'selected' : '' }}>
                                            {{ $occupant->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="service_type_id">Tipo de Serviço</label>
                                <select class="form-control" id="service_type_id" name="service_type_id" required>
                                    <option value="">Selecione um Tipo de Serviço</option>
                                    @foreach ($serviceTypes as $type)
                                        <option value="{{ $type->id }}"
                                            {{ $type->id == $roomService->service_type_id ? 'selected' : '' }}>
                                            {{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="cost">Custo</label>
                                <input type="number" class="form-control" id="cost" name="cost"
                                    placeholder="Custo do Serviço" step="0.01" value="{{ $roomService->cost }}" required>
                            </div>
                            <div class="form-group">
                                <label for="service_date">Data do Serviço</label>
                                <input type="date" class="form-control" id="service_date" name="service_date"
                                    value="{{ \Carbon\Carbon::parse($roomService->service_date)->format('Y-m-d') }}"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="observations">Observações</label>
                                <textarea class="form-control" id="observations" name="observations" rows="3">{{ $roomService->observations }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-success">Atualizar</button>
                            <a href="{{ route('receptionist.room-services.index') }}"
                                class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
