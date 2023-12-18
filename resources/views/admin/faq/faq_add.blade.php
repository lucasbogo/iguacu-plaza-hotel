@extends('admin.layout.master')

@section('heading', 'Adicionar Perguntas Frequentes')

@section('right_top_button')
    <a href="{{ route('admin_faq') }}" class="btn btn-primary"><i class="fa fa-eye"></i> Ver Todas Perguntas</a>
@endsection

@section('main_content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin_faq_store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label class="form-label">Pergunta *</label>
                                        <input type="text" class="form-control" name="question"
                                            value="{{ old('question') }}">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Resposta *</label>
                                        <textarea name="answer" class="form-control snote" cols="30" rows="10">{{ old('answer') }}</textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label"></label>
                                        <button type="submit" class="btn btn-primary">Enviar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
