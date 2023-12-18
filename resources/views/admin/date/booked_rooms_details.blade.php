@extends('admin.layout.master')

@section('heading', 'Quartos (Reservados e Disponíveis) para '.$selected_date)

@section('right_top_button')
<a href="{{ route('admin_date') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Voltar</a>
@endsection

@section('main_content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tipo</th>
                                    <th>Total</th>
                                    <th>Reservados</th>
                                    <th>Disponíveis</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $rooms = \App\Models\Room::get();
                                @endphp 
                                @foreach($rooms as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->total_rooms }}</td>
                                    <td>
                                        @php
                                        $cnt = \App\Models\BookedRoom::where('room_id',$row->id)->where('booking_date',$selected_date)->count();
                                        @endphp
                                        {{ $cnt }}
                                    </td>
                                    <td>
                                        {{ $row->total_rooms-$cnt }}
                                    </td>
                                </tr>
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