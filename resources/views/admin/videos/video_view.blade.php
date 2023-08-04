@extends('admin.layout.master')

@section('heading')
    <h3>Videos</h3>
@endsection

@section('right_top_button')
    <a href="{{ route('admin_video_add') }}" class="btn btn-success"><i class="fa fa-plus"></i>Adicionar</a>
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
                                        {{-- <th>Referencia</th> --}}
                                        <th>Video</th>
                                        <th>Legenda</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($videos as $row)
                                        <tr>
                                            {{-- <td>{{ $loop->iteration }}</td> --}}
                                            <td>
                                                <iframe width="200" height="100"
                                                    src="https://www.youtube.com/embed/{{ $row->video }}" frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen></iframe>
                                            </td>
                                            <td>{{ $row->caption }}</td>
                                            <td class="pt_10 pb_10">
                                                <a href="{{ route('admin_video_edit', $row->id) }}"
                                                    class="btn btn-primary">Editar</a>
                                                <form action="{{ route('admin_video_activate', $row->id) }}" method="POST"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <!-- Add this line to specify the HTTP method as PUT -->
                                                    <button type="submit"
                                                        class="btn btn-{{ $row->status ? 'warning' : 'success' }}">
                                                        {{ $row->status ? 'Desativar' : 'Ativar' }}
                                                    </button>
                                                </form>
                                                <a href="{{ route('admin_video_delete', $row->id) }}" class="btn btn-danger"
                                                    onClick="return confirm('Tem Certeza?');">Deletar</a>
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

@section('scripts')
    <!-- Include jQuery if not already included -->
    <!-- Your jQuery code for handling the activation buttons here -->
    <script>
        // Sample jQuery code for handling the "Ativar" button click event
        $(document).on('click', '.btn-ativar', function(e) {
            e.preventDefault();
            var videoId = $(this).data('id');
            // Send an AJAX PUT request to activate or deactivate the video
            $.ajax({
                url: `/admin/videos/${videoId}/activate`,
                type: 'PUT', // Use PUT method
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
                    // If successful, reload the page to reflect the updated status
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    // Handle the error if needed
                }
            });
        });
    </script>
@endsection