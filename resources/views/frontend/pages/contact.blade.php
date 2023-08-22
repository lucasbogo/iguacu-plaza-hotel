@extends('frontend.layout.master')

@section('main_content')
    <div class="page-top">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ $contact->contact_heading }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <form action="{{ route('contact_send_email') }}" method="POST" class="form_contact_ajax">
                        @csrf
                        <div class="contact-form">
                            <div class="mb-3">
                                <label for="" class="form-label">Nome Completo</label>
                                <input type="text" class="form-control" name="name">
                                <span class="text-danger error-text name_error"></span> <!-- Unique class for name field -->
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Email</label>
                                <input type="text" class="form-control" name="email">
                                <span class="text-danger error-text email_error"></span>
                                <!-- Unique class for email field -->
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Mensagem</label>
                                <textarea class="form-control" rows="3" name="message"></textarea>
                                <span class="text-danger error-text message_error"></span>
                                <!-- Unique class for message field -->
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary bg-website">Enviar Mensagem</button>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="map">
                        {!! $contact->contact_map !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        (function($) {
            $(".form_contact_ajax").on('submit', function(e) {
                e.preventDefault();
                $('#loader').show();
                var form = this;
                $.ajax({
                    url: $(form).attr('action'),
                    method: $(form).attr('method'),
                    data: new FormData(form),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        $(form).find('span.error-text').text('');
                    },
                    success: function(data) {
                        $('#loader').hide();
                        if (data.code == 0) {
                            $.each(data.error_message, function(prefix, val) {
                                $(form).find('span.' + prefix + '_error').text(val[0]);
                            });
                        } else if (data.code == 1) {
                            $(form)[0].reset();
                            iziToast.success({
                                title: '',
                                position: 'topRight',
                                message: data.success_message,
                            });
                        }

                    }
                });
            });
        })(jQuery);
    </script>
    <div id="loader"></div>
@endsection
