@extends('admin.layout.master')

@section('heading')
    {{-- <div>
        <img src="{{ asset('uploads/logo-hotel.png') }}" alt="Logo" alt="Logo" style="padding: 10px;"></a>
    </div> --}}
    <h3>Editar Vídeo</h3>
@endsection

@section('main_content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin_video_update', $video->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="video">Vídeo (ID do YouTube)</label>
                                <input type="text" name="video" id="video" class="form-control" required
                                    value="{{ $video->video }}">
                            </div>
                            <div class="form-group">
                                <label for="caption">Legenda</label>
                                <input type="text" name="caption" id="caption" class="form-control" required
                                    value="{{ $video->caption }}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                                <a href="{{ route('admin_video') }}" class="btn btn-danger">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
