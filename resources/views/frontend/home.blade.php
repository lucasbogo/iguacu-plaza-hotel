@extends('frontend.layout.master')

@section('main_content')
    <!-- Wrap the slider section in an if directive to check if there are active sliders -->
    @if (count($sliders) > 0)
        <div class="slider">
            <div class="slide-carousel owl-carousel" style="background-color: white;">
                @foreach ($sliders as $item)
                    <!-- Add an if directive to check if the current slider is active -->
                    @if ($item->status)
                        <div class="item"
                            style="background-image: url({{ asset('uploads/slider/' . $item->photo) }}); background-size: cover; background-repeat: no-repeat; background-position: center;">
                            <div class="bg"></div>
                            <div class="text">
                                <h2>{{ $item->heading }}</h2>
                                <p>{!! $item->text !!}</p>

                                @if ($item->button_text != null)
                                    <div class="button">
                                        <a href="{{ $item->button_url }}">{{ $item->button_text }}</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endif
    <br>
    <br>
    <br>
    <br>

    <div class="search-section" style="background-color: white;">
        <div class="container">
            <form action="cart.html" method="post">
                <div class="inner">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <select name="" class="form-select">
                                    <option value="">Selecionar quarto</option>
                                    <option value="">Casal</option>
                                    <option value="">Duplo solteiro</option>
                                    <option value="">Triplo</option>
                                    <option value="">Casal + solteiro</option>
                                    <option value="">Casal + duplo solteiro</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <input type="text" name="checkin_checkout" class="form-control daterange1"
                                    placeholder="Checkin & Checkout">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <input type="number" name="" class="form-control" min="1" max="30"
                                    placeholder="Adultos">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <input type="number" name="" class="form-control" min="1" max="30"
                                    placeholder="Crianças">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-primary">Reservar Agora</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="home-feature" style="background-color: white;">
        <div class="container">
            <div class="row">
                @foreach ($features as $item)
                    @if ($item->status)
                        <!-- Check if the feature is active -->
                        <div class="col-md-3">
                            <div class="inner">
                                <div class="icon"><i class="{{ $item->icon }}"></i></div>
                                <div class="text">
                                    <h2>{{ $item->heading }}</h2>
                                    <p>
                                        {{ $item->text }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>


    <div class="home-rooms">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="main-header">Quartos</h2>
                </div>
            </div>
            <div class="row">
                @if (count($rooms) > 0)
                    @foreach ($rooms as $item)
                        @if ($loop->iteration > 4)
                        @break
                    @endif
                    <div class="col-md-3">
                        <div class="inner">
                            <div class="photo">
                                <img src="{{ asset('uploads/' . $item->featured_image) }}" alt="">
                            </div>
                            <div class="text">
                                <h2><a href="{{ route('room_detail', $item->id) }}">{{ $item->name }}</a></h2>
                                <div class="price">
                                    R$ {{ $item->price }}/diária
                                </div>
                                <div class="button">
                                    <a href="{{ route('room_detail', $item->id) }}"
                                        class="btn btn-primary">Informações</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>Sem quartos disponíveis no momento.</p>
            @endif
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="big-button">
                    <a href="{{ route('rooms') }}" class="btn btn-primary">Ver Todos</a>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>

@php
    // Check if there are no testimonials or no active testimonials
    $hasTestimonials = count($testimonials) > 0;
    $hasActiveTestimonials = $testimonials->contains('status', true);
@endphp

@if ($hasTestimonials && $hasActiveTestimonials)
    <!-- Show the testimonials section when there are testimonials and at least one is active -->
    <div class="testimonial" style="background-image: url(uploads/piscina2.jpg)">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="main-header">Nossos clientes</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="testimonial-carousel owl-carousel">
                        @foreach ($testimonials as $item)
                            @if ($item->status)
                                <!-- Check if the testimonial is active (status is true) -->
                                <div class="item">
                                    <div class="photo">
                                        <img src="{{ asset('uploads/testimonial/' . $item->photo) }}" alt="">
                                    </div>
                                    <div class="text">
                                        <h4>{{ $item->name }}</h4>
                                        <p>{{ $item->designation }}</p>
                                    </div>
                                    <div class="description">
                                        <p>
                                            {!! $item->comment !!}
                                        </p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if ($blogs->count() > 0)
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
@endif
@endsection
