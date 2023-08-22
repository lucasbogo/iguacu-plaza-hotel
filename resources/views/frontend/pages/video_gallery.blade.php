@extends('frontend.layout.master')

@section('main_content')
    <div class="page-top">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Conheça Foz do Iguaçu</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
            <div class="video-gallery">
                <div class="row">
                    @forelse ($videos as $item)
                        @if ($item->status)
                            <div class="col-lg-3 col-md-4">
                                <div class="video-thumb">
                                    <img src="http://img.youtube.com/vi/{{ $item->video }}/0.jpg" alt="">
                                    <div class="bg"></div>
                                    <div class="icon">
                                        <a href="http://www.youtube.com/watch?v={{ $item->video }}" class="video-button"><i
                                                class="fa fa-play"></i></a>
                                    </div>
                                </div>
                                <div class="video-caption">
                                    {{ $item->caption }}
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="col-md-12">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="alert alert-info" role="alert">
                                            Não há vídeos disponíveis no momento.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforelse
                    <div class="col-md-12">
                        {{ $videos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
