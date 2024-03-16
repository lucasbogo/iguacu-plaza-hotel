@extends('receptionist.layout.master')

@section('title', 'Ocupações Fechadas')

@section('main_content')
<div class="container mt-5">
    <h2>Ocupações Fechadas</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Data de Check-out</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($closedOccupancies as $occupant)
                <tr>
                    <td>{{ $occupant->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($occupant->check_out)->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('receptionist.occupants.details', $occupant->id) }}" class="btn btn-info">Detalhes</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
