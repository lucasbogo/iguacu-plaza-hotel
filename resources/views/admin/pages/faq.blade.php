@extends('admin.layout.master')

@section('heading')
    {{-- <div>
        <img src="{{ asset('uploads/logo-hotel.png') }}" alt="Logo" alt="Logo" style="padding: 10px;"></a>
    </div> --}}
    <h3>Editar Página: Perguntas Frequentes</h3>
@endsection

@section('main_content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin_page_faq_update') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label class="form-label">Título *</label>
                                        <input type="text" class="form-control" name="faq_heading"
                                            value="{{ $page->faq_heading }}">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Status *</label>
                                        <select name="faq_status" class="form-control">
                                            <option value="1" @if ($page->faq_status == 1) selected @endif>Mostrar
                                            </option>
                                            <option value="0" @if ($page->faq_status == 0) selected @endif>
                                                Esconder</option>
                                        </select>
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
