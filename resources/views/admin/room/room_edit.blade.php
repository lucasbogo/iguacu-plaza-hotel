@extends('admin.layout.master')

@section('heading')
    {{-- <div>
        <img src="{{ asset('uploads/logo-hotel.png') }}" alt="Logo" alt="Logo" style="padding: 10px;"></a>
    </div> --}}
    <h3>Adicionar Quartos</h3>
@endsection

@section('right_top_button')
    <a href="{{ route('admin_room') }}" class="btn btn-primary"><i class="fa fa-eye"></i> Ver Todos</a>
@endsection

@section('main_content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin_room_update', $room->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label class="form-label">Imagem Incial</label>
                                        <div>
                                            <img src="{{ asset('uploads/' . $room->featured_image) }}" alt=""
                                                class="w_200">
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Mudar a foto principal</label>
                                        <div>
                                            <input type="file" name="featured_image">
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Nome/Tipo *</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ $room->name }}">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Descrição *</label>
                                        <textarea name="description" class="form-control snote" cols="30" rows="10">{{ $room->description }}</textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Valor *</label>
                                        <input type="text" class="form-control" name="price"
                                            value="{{ $room->price }}">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Total de Quartos/Tipo *</label>
                                        <input type="text" class="form-control" name="total_rooms"
                                            value="{{ $room->total_rooms }}">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Comodidades</label>
                                        @php $i=0; @endphp
                                        @foreach ($amenities as $item)
                                            @if (in_array($item->id, $existing_amenities))
                                                @php $checked_type = 'checked'; @endphp
                                            @else
                                                @php $checked_type = ''; @endphp
                                            @endif

                                            @php $i++; @endphp
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="{{ $item->id }}"
                                                    id="defaultCheck{{ $i }}" name="arr_amenities[]"
                                                    {{ $checked_type }}>
                                                <label class="form-check-label" for="defaultCheck{{ $i }}">
                                                    {{ $item->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Tamanho</label>
                                        <input type="text" class="form-control" name="size"
                                            value="{{ $room->size }}">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Camas</label>
                                        <input type="text" class="form-control" name="total_beds"
                                            value="{{ $room->total_beds }}">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Banheiros</label>
                                        <input type="text" class="form-control" name="total_bathrooms"
                                            value="{{ $room->total_bathrooms }}">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Sacadas</label>
                                        <input type="text" class="form-control" name="total_balconies"
                                            value="{{ $room->total_balconies }}">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">PAX</label>
                                        <input type="text" class="form-control" name="total_guests"
                                            value="{{ $room->total_guests }}">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Video</label>
                                        <div class="iframe-container1">
                                            <iframe width="560" height="315"
                                                src="https://www.youtube.com/embed/{{ $room->video_id }}"
                                                title="YouTube video player" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen></iframe>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Video Id</label>
                                        <input type="text" class="form-control" name="video_id"
                                            value="{{ $room->video_id }}">
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
