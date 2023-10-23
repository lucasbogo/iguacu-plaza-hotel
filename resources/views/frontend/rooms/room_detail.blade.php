@extends('frontend.layout.master')

@section('main_content')
    <div class="page-top">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ $room->name }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content room-detail">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-7 col-sm-12 left">

                    <div class="room-detail-carousel owl-carousel">
                        <div class="item" style="background-image:url({{ asset('uploads/' . $room->featured_image) }});">
                            <div class="bg"></div>
                        </div>

                        @foreach ($room->rRoomImage as $item)
                            <div class="item" style="background-image:url({{ asset('uploads/' . $item->image) }});">
                                <div class="bg"></div>
                            </div>
                        @endforeach

                    </div>

                    <div class="description">
                        {!! $room->description !!}
                    </div>

                    <div class="amenity">
                        <div class="row">
                            <div class="col-md-12">
                                <h2>Comodidades</h2>
                            </div>
                        </div>
                        <div class="row">
                            @php
                                $arr = explode(',', $room->amenities);
                                for ($j = 0; $j < count($arr); $j++) {
                                    $temp_row = \App\Models\Amenity::find($arr[$j]); // Use find() instead of where() to simplify
                                    if ($temp_row) {
                                        echo '<div class="col-lg-6 col-md-12">';
                                        echo '<div class="item"><i class="fa fa-check-circle"></i> ' . $temp_row->name . '</div>';
                                        echo '</div>';
                                    }
                                }
                            @endphp
                        </div>
                    </div>

                    <div class="feature">
                        <div class="row">
                            <div class="col-md-12">
                                <h2>Características</h2>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                @if (!is_null($room->size))
                                    <tr>
                                        <th>Tamanho do quarto</th>
                                        <td>{{ $room->size }}</td>
                                    </tr>
                                @endif

                                @if (!is_null($room->total_beds))
                                    <tr>
                                        <th>Camas</th>
                                        <td>{{ $room->total_beds }}</td>
                                    </tr>
                                @endif

                                @if (!is_null($room->total_bathrooms))
                                    <tr>
                                        <th>banheiros</th>
                                        <td>{{ $room->total_bathrooms }}</td>
                                    </tr>
                                @endif

                                @if (!is_null($room->total_balconies))
                                    <tr>
                                        <th>Sacadas</th>
                                        <td>{{ $room->total_balconies }}</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>

                    @if ($room->video_id != '')
                        <div class="video">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $room->video_id }}"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>
                    @endif
                </div>

                <div class="col-lg-4 col-md-5 col-sm-12 right">
                    <div class="sidebar-container" id="sticky_sidebar">
                        <div class="widget">
                            <h2>Valor da diária</h2>
                            <div class="price">
                                R${{ $room->price }}
                            </div>
                        </div>
                        {{-- <div class="widget">
                            <h2>Reservar este quarto</h2>
                            <form action="{{ route('cart_submit') }}" method="post">
                                @csrf
                                <input type="hidden" name="room_id" value="{{ $room->id }}">
                                <div class="form-group mb_20">
                                    <label for="">Check-in & Check-out</label>
                                    <input type="text" name="checkin_checkout" class="form-control daterange1"
                                        placeholder="Checkin & Checkout">
                                </div>
                                <div class="form-group mb_20">
                                    <label for="">Adultos</label>
                                    <input type="number" name="adult" class="form-control" min="1" max="30"
                                        placeholder="Adults">
                                </div>
                                <div class="form-group mb_20">
                                    <label for="">Crianças</label>
                                    <input type="number" name="children" class="form-control" min="0" max="30"
                                        placeholder="Children">
                                </div>
                                <button type="submit" class="book-now">Adicionar ao Carrinho</button>
                            </form>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                iziToast.error({
                    title: '',
                    position: 'topRight',
                    message: '{{ $error }}',
                });
            </script>
        @endforeach
    @endif
@endsection
