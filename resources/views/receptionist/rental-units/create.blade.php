@extends('receptionist.layout.master')

@section('title', 'Adicionar Nova Unidade de Aluguel')

@section('main_content')
    <div class="section-header">
        <h1>Adicionar quarto (mensalista)</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Informações do quarto</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('receptionist.rental-units.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="number">Número</label>
                                <input type="text" class="form-control" id="number" name="number"
                                    placeholder="Número do quarto" required>
                            </div>  
                            <div class="form-group">
                                <label for="type">Tipo do quarto</label>
                                <select class="form-control" id="type" name="type">
                                    <option value="single">Single</option>
                                    <option value="double">Duplo</option>
                                    <option value="couple">Casal</option>
                                    <option value="triple">Triplo</option>
                                    <option value="quadruple">Quádruplo</option>
                                    <option value="couple_plus_one">Casal + 1</option>
                                    <option value="couple_plus_two">Casal + 2</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status da Unidade</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="available">Disponível</option>
                                    <option value="occupied">Ocupado</option>
                                    <option value="maintenance">Manutenção</option>
                                    <option value="housekeeping">Limpeza</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="observations">Observações</label>
                                <textarea class="form-control" id="observations" name="observations" rows="3" placeholder="Observações"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success">Salvar Unidade</button>
                            <a href="{{ route('receptionist.rental-units.index') }}" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
