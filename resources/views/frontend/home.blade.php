@extends('frontend.layout.master')

@section('main_content')
    <div class="slider">
        <div class="slide-carousel owl-carousel">

            @foreach ($sliders as $item)
                <div class="item" style="background-image:url({{ asset('uploads/slider/' . $item->photo) }})">
                    <div class="bg"></div>
                    <div class="text">
                        <h2>{{ $item->heading }}</h2>
                        <p>
                            {!! $item->text !!}
                        </p>

                        @if ($item->button_text != null)
                            <div class="button">
                                <a href="{{ $item->button_url }}">{{ $item->button_text }}</a>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="search-section">
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

    <div class="home-feature">
        <div class="container">
            <div class="row">

                @foreach ($features as $item)
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
                <div class="col-md-3">
                    <div class="inner">
                        <div class="photo">
                            <img src="{{ asset('uploads/DSC_0661.jpg') }}" alt="">
                        </div>
                        <div class="text">
                            <h2><a href="">Casal</a></h2>
                            <div class="price">
                                $100/night
                            </div>
                            <div class="button">
                                <a href="room-detail.html" class="btn btn-primary">Informações</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="inner">
                        <div class="photo">
                            <img src="{{ asset('uploads/DSC_0801.jpg') }}" alt="">
                        </div>
                        <div class="text">
                            <h2><a href="">Duplo solteiro</a></h2>
                            <div class="price">
                                $100/night
                            </div>
                            <div class="button">
                                <a href="room-detail.html" class="btn btn-primary">Informações</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="inner">
                        <div class="photo">
                            <img src="{{ asset('uploads/DSC_0544.jpg') }}" alt="">
                        </div>
                        <div class="text">
                            <h2><a href="">Triplo</a></h2>
                            <div class="price">
                                $100/night
                            </div>
                            <div class="button">
                                <a href="room-detail.html" class="btn btn-primary">Informações</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="inner">
                        <div class="photo">
                            <img src="{{ asset('uploads/DSC_0594.jpg') }}" alt="">
                        </div>
                        <div class="text">
                            <h2><a href="">Casal + solteiro</a></h2>
                            <div class="price">
                                $100/night
                            </div>
                            <div class="button">
                                <a href="room-detail.html" class="btn btn-primary">See Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="inner">
                        <div class="photo">
                            <img src="{{ asset('uploads/5.jpg') }}" alt="">
                        </div>
                        <div class="text">
                            <h2><a href="">Casal + duplo solteiro</a></h2>
                            <div class="price">
                                $100/night
                            </div>
                            <div class="button">
                                <a href="room-detail.html" class="btn btn-primary">Informações</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="inner">
                        <div class="photo">
                            <img src="{{ asset('uploads/6.jpg') }}" alt="">
                        </div>
                        <div class="text">
                            <h2><a href="">Quadruplo</a></h2>
                            <div class="price">
                                $100/night
                            </div>
                            <div class="button">
                                <a href="room-detail.html" class="btn btn-primary">See Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="inner">
                        <div class="photo">
                            <img src="{{ asset('uploads/7.jpg') }}" alt="">
                        </div>
                        <div class="text">
                            <h2><a href="">Casal + duplo solteiro</a></h2>
                            <div class="price">
                                $100/night
                            </div>
                            <div class="button">
                                <a href="room-detail.html" class="btn btn-primary">See Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="inner">
                        <div class="photo">
                            <img src="{{ asset('uploads/1.jpg') }}" alt="">
                        </div>
                        <div class="text">
                            <h2><a href="">Standard Couple Bed</a></h2>
                            <div class="price">
                                $100/night
                            </div>
                            <div class="button">
                                <a href="room-detail.html" class="btn btn-primary">See Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="big-button">
                        <a href="" class="btn btn-primary">Ver Todos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (count($testimonials) > 0)
        <!-- Check if there are testimonials in the $testimonials array -->
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
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <div class="blog-item">
        <div class="container">
            @if (count($blogs) > 0)
                <!-- Check if there are blogs in the $blogs array -->
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="main-header">Blog Iguaçu Plaza</h2>
                    </div>
                </div>
                @foreach ($blogs as $item)
                    <div class="row">
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
                    </div>
                @endforeach
            @endif
        </div>
    </div>

@endsection
