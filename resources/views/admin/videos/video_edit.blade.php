@extends('admin.layout.app')

@section('heading', 'Edit FAQ')

@section('right_top_button')
<a href="{{ route('admin_faq_view') }}" class="btn btn-primary"><i class="fa fa-eye"></i> Ver Todos</a>
@endsection

@section('main_content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin_faq_update',$faqs->id) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-4">
                                    <label class="form-label">Pergunta *</label>
                                    <input type="text" class="form-control" name="question" value="{{ $faqs->question }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Resposta *</label>
                                    <textarea name="answer" class="form-control snote" cols="30" rows="10">{{ $faqs->answer }}</textarea>
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