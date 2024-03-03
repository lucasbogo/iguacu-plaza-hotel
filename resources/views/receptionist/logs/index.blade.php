@extends('receptionist.layout.master')

@section('title', 'Visualizar Logs')

@section('main_content')
    <div class="section-body">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Logs</h2>
            <a href="{{ route('receptionist.logs.create') }}" class="btn btn-success">Adicionar Log</a>
        </div>

        <div class="table-responsive mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Mensagem</th>
                        <th>Status</th>
                        <th>Criado em</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logs as $log)
                        <tr>
                            <td>{!! $log->message !!}</td>
                            <td>
                                @switch($log->status)
                                    @case('resolved')
                                        Resolvido
                                    @break

                                    @case('pending')
                                        Pendente
                                    @break

                                    @case('cannot_be_resolved')
                                        Não pode ser resolvido
                                    @break

                                    @default
                                        Desconhecido
                                @endswitch
                            </td>
                            <td>{{ $log->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('receptionist.logs.edit', $log->id) }}"
                                    class="btn btn-primary btn-sm">Atualizar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
