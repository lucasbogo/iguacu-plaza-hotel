@extends('admin.layout.master')

@section('heading', 'Disponibilidade por Data')

@section('main_content')
    <div class="section-body">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin_date_submit') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label class="form-label">Selecionar Data *</label>
                                        <input type="text" class="form-control" name="selected_date" pattern="\d{2}/\d{2}/\d{4}" placeholder="DD/MM/YYYY">
                                        <small class="form-text text-muted">Formato: DD/MM/YYYY</small>
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