@extends('receptionist.layout.master')

@section('title', 'Adicionar Tipo de Serviço')

@section('main_content')
    <div class="section-header">
        <h1>Adicionar Tipo de Serviço</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Informações do Tipo de Serviço</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('receptionist.service-types.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nome do Serviço</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Nome do Serviço" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Descrição</label>
                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Descrição do Serviço"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success">Salvar</button>
                            <a href="{{ route('receptionist.service-types.index') }}" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
