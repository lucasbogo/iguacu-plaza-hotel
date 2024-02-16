@extends('frontend.layout.master')

@section('main_content')
    <div class="page-top">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ $blog->title }}</h2>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-6212352ed76fda0a"></script>

    <div class="page-content">
        <div class="container">
            <div class="row justify-content-center">
                @if ($blog)
                    <div class="col-lg-8 col-md-12">
                        <div class="featured-photo">
                            <img src="{{ asset('uploads/blog/' . $blog->photo) }}" alt="">
                        </div>
                        <div class="sub">
                            <div class="item">
                                <b><i class="fa fa-user"></i></b>
                                {{ $blog->author }}
                            </div>
                            <div class="item">
                                <b><i class="fa fa-clock-o"></i></b>
                                {{ $blog->created_at->format('d M, Y') }}
                            </div>
                            <div class="item">
                                <b><i class="fa fa-eye"></i></b>
                                {{ $blog->views }}
                            </div>
                        </div>
                        <div class="main-text">
                            <p>
                                {!! $blog->content !!}
                            </p>
                        </div>
                        {{-- <div class="share-content">
                            <h2>Compartilhar</h2>
                            <div class="addthis_inline_share_toolbox"></div>
                        </div> --}}
                    </div>
                @else
                    <div class="col-lg-8 col-md-12">
                        <div class="alert alert-info">
                            Não há posts de blog no momento.
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
