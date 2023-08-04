@extends('admin.layout.master')

@section('heading')
    <h3>Editar Pergunta Frequente</h3>
@endsection

@section('main_content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin_faq_update', $faq->id) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label class="form-label">Pergunta *</label>
                                        <input type="text" class="form-control" name="question"
                                            value="{{ $faq->question }}">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Resposta *</label>
                                        <textarea name="answer" class="form-control snote" cols="30" rows="10">{{ $faq->answer }}</textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label"></label>
                                        <button type="submit" class="btn btn-primary">Atualizar</button>
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
