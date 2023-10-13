@extends('admin.layout.master')

@section('heading')
    <h3>Editar Comodidade</h3>
@endsection

@section('main_content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin_amenity_update', $amenities->id) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label class="form-label">Nome *</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ $amenities->name }}">
                                    </div>
                                    <label class="form-label"></label>
                                    <button type="submit" class="btn btn-primary">Atualizar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
