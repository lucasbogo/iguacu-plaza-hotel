@extends('receptionist.layout.master')

@section('title', 'Adicionar Serviço de Quarto')

@section('main_content')
    <div class="section-header">
        <h1>Adicionar Serviço de Quarto</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Informações do Serviço</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('receptionist.room-services.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="occupant_id">Mensalista</label>
                                <select class="form-control" id="occupant_id" name="occupant_id" required>
                                    <option value="">Selecione um Mensalista</option>
                                    @foreach ($occupants as $occupant)
                                        <option value="{{ $occupant->id }}">{{ $occupant->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="service_type_id">Tipo de Serviço</label>
                                <select class="form-control" id="service_type_id" name="service_type_id" required>
                                    <option value="">Selecione um Tipo de Serviço</option>
                                    @foreach ($serviceTypes as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="cost">Custo</label>
                                <input type="number" class="form-control" id="cost" name="cost"
                                    placeholder="Custo do Serviço" step="0.01" required>
                            </div>
                            <div class="form-group">
                                <label for="service_date">Data do Serviço</label>
                                <input type="date" class="form-control" id="service_date" name="service_date" required>
                            </div>
                            <div class="form-group">
                                <label for="observations">Observações</label>
                                <textarea class="form-control" id="observations" name="observations" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success">Salvar</button>
                            <a href="{{ route('receptionist.room-services.index') }}" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
