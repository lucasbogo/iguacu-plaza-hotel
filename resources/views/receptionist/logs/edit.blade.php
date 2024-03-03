@extends('receptionist.layout.master')

@section('title', 'Editar Log')

@push('css')
    <!-- Include Summernote CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
@endpush

@section('main_content')
    <div class="section-header">
        <h1>Editar Log</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Editar Log</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('receptionist.logs.update', $log->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="message">Mensagem</label>
                                <textarea name="message" id="message" class="form-control snote">{{ old('message', $log->message) }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Atualizar</button>
                            <a href="{{ route('receptionist.logs.index') }}" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Include Summernote JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.snote').summernote({
                height: 200
            });
        });
    </script>
@endpush
