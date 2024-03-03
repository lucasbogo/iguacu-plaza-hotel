@extends('receptionist.layout.master')

@section('title', 'Criar Novo Log')

@section('main_content')
    <div class="section-header">
        <h1>Criar Novo Log</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Detalhes do Log</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('receptionist.logs.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="message">Mensagem</label>
                                <textarea name="message" class="form-control snote" cols="30" rows="10" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="pending">Pendente</option>
                                    <option value="resolved">Resolvido</option>
                                    <option value="cannot_be_resolved">Não pode ser resolvido</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success">Criar Log</button>
                            <a href="{{ route('receptionist.logs.index') }}" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.snote').summernote({
                height: 200
            });
        });
    </script>
@endsection
