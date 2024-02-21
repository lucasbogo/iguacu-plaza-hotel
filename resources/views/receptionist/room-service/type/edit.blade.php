@extends('receptionist.layout.master')

@section('title', 'Editar Tipo de Serviço')

@section('main_content')
    <div class="section-header">
        <h1>Editar Tipo de Serviço</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Informações do Tipo de Serviço</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('receptionist.service-types.update', $serviceType->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $serviceType->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Descrição</label>
                                <textarea class="form-control" id="description" name="description" rows="3">{{ $serviceType->description }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-success">Atualizar</button>
                            <a href="{{ route('receptionist.service-types.index') }}" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
