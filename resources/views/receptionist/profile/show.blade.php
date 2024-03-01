@extends('receptionist.layout.master')

@section('heading')
    Editar Perfil
@endsection

@section('main_content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('receptionist.profile.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <div style="margin-bottom: 10px; text-align: center;">
                                        <label for="photo" style="display: block;">Foto de Perfil Atual</label>
                                        @php $receptionistPhoto = Auth::guard('receptionist')->user()->photo; @endphp
                                        <img src="{{ $receptionistPhoto ? asset('uploads/receptionist/' . $receptionistPhoto) : asset('path/to/user-placeholder.png') }}"
                                            alt="Foto de Perfil" class="profile-photo"
                                            style="max-width: 150px; max-height: 150px; width: auto; height: auto; margin-bottom: 10px; border-radius: 0%;">
                                    </div>
                                    <input type="file" class="form-control" name="photo" id="photo">
                                    @if ($receptionistPhoto)
                                        <button type="button" class="btn btn-danger mt-2" id="deletePhotoBtn">Deletar
                                            Foto</button>
                                    @endif
                                </div>

                                <div class="col-md-9">
                                    <div class="col-md-9">
                                        <div class="mb-4">
                                            <label class="form-label">Nome</label>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ Auth::guard('receptionist')->user()->name }}">
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Usuário</label>
                                            <input type="text" class="form-control" name="username"
                                                value="{{ Auth::guard('receptionist')->user()->username }}">
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Nova Senha</label>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Confirmar Nova Senha</label>
                                            <input type="password" class="form-control" name="retype_password">
                                        </div>
                                        <div class="mb-4">
                                            <button type="submit" class="btn btn-success">Atualizar</button>
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('deletePhotoBtn').addEventListener('click', function() {
            if (confirm('Tem certeza que deseja deletar a foto?')) {
                fetch('{{ route('receptionist.profile.delete-photo') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({}),
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        if (data.success) {
                            alert('Foto deletada com sucesso!');
                            window.location.reload(); // Reload the page to reflect changes
                        } else {
                            alert('Erro ao deletar a foto.');
                        }
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                        alert('Erro ao deletar a foto.');
                    });
            }
        });
    </script>
@endsection
