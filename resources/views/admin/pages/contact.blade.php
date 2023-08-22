@extends('admin.layout.master')

@section('heading')
    {{-- <div>
        <img src="{{ asset('uploads/logo-hotel.png') }}" alt="Logo" alt="Logo" style="padding: 10px;"></a>
    </div> --}}
    <h3>Contato</h3>
@endsection

@section('main_content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin_page_contact_update') }}" method="post" class="form_contact_ajax">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label class="form-label">Titulo *</label>
                                        <input type="text" class="form-control" name="contact_heading"
                                            value="{{ $page->contact_heading }}">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Mapa *</label>
                                        <textarea name="contact_map" class="form-control h_100" cols="30" rows="10">{{ $page->contact_map }}</textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Status * (esconder ou não da página cliente)</label>
                                        <select name="contact_status" class="form-control">
                                            <option value="1" @if ($page->contact_status == 1) selected @endif>Mostrar
                                            </option>
                                            <option value="0" @if ($page->contact_status == 0) selected @endif>
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
