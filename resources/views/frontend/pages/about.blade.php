@extends('frontend.layout.master')

@section('main_content')
    @if ($about->about_status == 0)
        <div class="alert alert-info">
            <p>página em construção</p>
        </div>
    @else
        <div class="page-top">
            <div class="bg"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>{{ $about->about_heading }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p>
                            {!! $about->about_content !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
