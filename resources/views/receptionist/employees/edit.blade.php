@extends('receptionist.layout.master')

@section('title', 'Editar Funcionário')

@section('main_content')
    <div class="section-header">
        <h1>Editar Funcionário</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Informações do Funcionário</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('receptionist.employees.update', $employee->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $employee->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="position">Cargo</label>
                                <input type="text" class="form-control" id="position" name="position"
                                    value="{{ $employee->position }}">
                            </div>
                            <button type="submit" class="btn btn-success">Salvar Alterações</button>
                            <a href="{{ route('receptionist.employees.index') }}" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
