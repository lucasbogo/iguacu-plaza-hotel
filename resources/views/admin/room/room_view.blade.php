@extends('admin.layout.master')

@section('heading')
    {{-- <div>
        <img src="{{ asset('uploads/logo-hotel.png') }}" alt="Logo" alt="Logo" style="padding: 10px;"></a>
    </div> --}}
    <h3>Quartos</h3>
@endsection

@section('right_top_button')
    <a href="{{ route('admin_room_add') }}" class="btn btn-success"><i class="fa fa-plus"></i>Adicionar</a>
@endsection

@section('main_content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="example1">
                                <thead>
                                    <tr>
                                        {{-- <th>SL</th> --}}
                                        <th>Imagem</th>
                                        <th>Nome/Tipo</th>
                                        <th>Valor (por noite)</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=0; @endphp
                                    @foreach ($rooms as $row)
                                        @php $i++; @endphp
                                        <tr>
                                            {{-- <td>{{ $loop->iteration }}</td> --}}
                                            <td>
                                                <img src="{{ asset('uploads/' . $row->featured_image) }}" alt=""
                                                    class="w_200">
                                            </td>
                                            <td>
                                                @if (isset($row->name))
                                                    {{ $row->name }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>${{ $row->price }}</td>
                                            <!-- Inside your loop where you display rooms -->
                                            <td class="pt_10 pb_10">
                                                <button class="btn btn-warning" data-toggle="modal"
                                                    data-target="#exampleModal{{ $i }}">Detalhes</button>
                                                <a href="{{ route('admin_room_gallery', $row->id) }}"
                                                    class="btn btn-success">Galleria</a>
                                                <a href="{{ route('admin_room_edit', $row->id) }}"
                                                    class="btn btn-primary">Editar</a>
                                                <a href="{{ route('admin_room_delete', $row->id) }}" class="btn btn-danger"
                                                    onClick="return confirm('Você tem Certeza?');">Excluír</a>

                                                @if ($row->status)
                                                    <form action="{{ route('admin_room_deactivate', $row->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('put')
                                                        <button type="submit" class="btn btn-secondary">Desativar</button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('admin_room_activate', $row->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('put')
                                                        <button type="submit" class="btn btn-success">Ativar</button>
                                                    </form>
                                                @endif
                                            </td>

                                        </tr>

                                        <div class="modal fade" id="exampleModal{{ $i }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Detalhes do Quarto</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true"></span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="form-group row bdb1 pt_10 mb_0">
                                                            <div class="col-md-4"><label class="form-label">Imagem</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <img src="{{ asset('uploads/' . $row->featured_image) }}"
                                                                    alt="" class="w_200">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row bdb1 pt_10 mb_0">
                                                            <div class="col-md-4"><label
                                                                    class="form-label">Nome/Tipo</label></div>
                                                            <div class="col-md-8">{{ $row->name }}</div>
                                                        </div>
                                                        <div class="form-group row bdb1 pt_10 mb_0">
                                                            <div class="col-md-4"><label
                                                                    class="form-label">Descrição</label></div>
                                                            <div class="col-md-8">{!! $row->description !!}</div>
                                                        </div>
                                                        <div class="form-group row bdb1 pt_10 mb_0">
                                                            <div class="col-md-4"><label class="form-label">Valor (por
                                                                    noite)</label></div>
                                                            <div class="col-md-8">
                                                                @if (isset($row->price))
                                                                    ${{ $row->price }}
                                                                @else
                                                                    N/A
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group row bdb1 pt_10 mb_0">
                                                            <div class="col-md-4"><label class="form-label">Total de
                                                                    Quartos</label></div>
                                                            <div class="col-md-8">{{ $row->total_rooms }}</div>
                                                        </div>
                                                        <div class="form-group row bdb1 pt_10 mb_0">
                                                            <div class="col-md-4">
                                                                <label class="form-label">Comodidades</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                @forelse ($amenities as $amenity)
                                                                    {{ $amenity->name }}<br>
                                                                @empty
                                                                    N/A
                                                                @endforelse
                                                                {{-- Total de Comodidades: {{ $checkedAmenitiesCount }} --}}
                                                            </div>
                                                        </div>
                                                        <div class="form-group row bdb1 pt_10 mb_0">
                                                            <div class="col-md-4"><label class="form-label">Tamanho</label>
                                                            </div>
                                                            <div class="col-md-8">{{ $row->size }}</div>
                                                        </div>
                                                        <div class="form-group row bdb1 pt_10 mb_0">
                                                            <div class="col-md-4"><label class="form-label">Total de
                                                                    Camas</label></div>
                                                            <div class="col-md-8">{{ $row->total_beds }}</div>
                                                        </div>
                                                        <div class="form-group row bdb1 pt_10 mb_0">
                                                            <div class="col-md-4"><label class="form-label">Total de
                                                                    Banheiros</label></div>
                                                            <div class="col-md-8">{{ $row->total_bathrooms }}</div>
                                                        </div>
                                                        <div class="form-group row bdb1 pt_10 mb_0">
                                                            <div class="col-md-4"><label class="form-label">Total de
                                                                    Sacadas</label></div>
                                                            <div class="col-md-8">{{ $row->total_balconies }}</div>
                                                        </div>
                                                        <div class="form-group row bdb1 pt_10 mb_0">
                                                            <div class="col-md-4"><label class="form-label">Total
                                                                    PAX</label></div>
                                                            <div class="col-md-8">{{ $row->total_guests }}</div>
                                                        </div>
                                                        <div class="form-group row bdb1 pt_10 mb_0">
                                                            <div class="col-md-4">
                                                                <label class="form-label">Video</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="iframe-container1">
                                                                    <iframe width="560" height="315"
                                                                        src="https://www.youtube.com/embed/{{ $row->video_id }}"
                                                                        title="YouTube video player" frameborder="0"
                                                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                                        allowfullscreen></iframe>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
