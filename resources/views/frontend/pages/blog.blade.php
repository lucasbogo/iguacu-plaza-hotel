@extends('frontend.layout.master')

@section('main_content')
    <div class="page-top">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Blog</h2>
                </div>
            </div>
        </div>
    </div>
    <br>

    @if ($blogs->count() > 0)
        <!-- Check if there are active blog posts -->
        <div class="blog-item">
            <div class="container">
                <div class="row">
                    @foreach ($blogs as $item)
                        @if ($item->status)
                            <!-- Check if the blog post is active (status is true) -->
                            <div class="col-md-4">
                                <div class="inner">
                                    <div class="photo">
                                        <img src="{{ asset('uploads/blog/' . $item->photo) }}" alt="">
                                    </div>
                                    <div class="text">
                                        <h2><a href="{{ route('post', $item->id) }}">{{ $item->title }}</a></h2>
                                        <div class="short-des">
                                            <p>
                                                {{ $item->short_content }}
                                            </p>
                                        </div>
                                        <div class="button">
                                            <a href="{{ route('post', $item->id) }}" class="btn btn-primary">Ler</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                {{ $blogs->links() }}
            </div>
        </div>
    @else
        <!-- If there are no active blog posts -->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="alert alert-info" role="alert">
                        Não há postagens de blog no momento.
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
