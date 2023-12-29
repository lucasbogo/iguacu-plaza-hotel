@extends('admin.layout.master')

@section('heading', 'Edit Video')

@section('right_top_button')
<a href="{{ route('admin_video') }}" class="btn btn-primary"><i class="fa fa-eye"></i> Ver Todos</a>
@endsection

@section('main_content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin_video_update',$video->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-4">
                                    <label class="form-label">Preview</label>
                                    <div class="iframe-container1">
                                        <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $video->video }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                </div>
                                {{-- <div class="mb-4">
                                    <label class="form-label">Id *</label>
                                    <input type="text" class="form-control" name="video_id" value="{{ $video->video_id }}">
                                </div> --}}
                                <div class="mb-4">
                                    <label class="form-label">Legenda</label>
                                    <input type="text" class="form-control" name="caption" value="{{ $video->caption }}">
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