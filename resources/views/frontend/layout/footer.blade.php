<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="item">
                    <h2 class="heading">Iguaçu Plaza Hotel</h2>
                    <ul class="useful-links">
                        <li><a href="rooms.html">Quartos</a></li>
                        @if ($global_page->about_status == 1)
                            <li><a href="{{ route('about') }}">Sobre Nós</a></li>
                        @endif

                        @if ($global_page->image_gallery_status == 1)
                            <li><a href="{{ route('image_gallery') }}">Galeria de Fotos</a></li>
                        @endif

                        @if ($global_page->video_gallery_status == 1)
                            <li><a href="{{ route('video_gallery') }}">Galeria de Videos</a></li>
                        @endif

                        @if ($global_page->blog_status == 1)
                            <li><a href="{{ route('blog') }}">Blog</a></li>
                        @endif

                        @if ($global_page->contact_status == 1)
                            <li><a href="{{ route('contact') }}">{{ $global_page->contact_heading }}</a></li>
                        @endif

                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <div class="item">
                    <h2 class="heading">Informações</h2>
                    <ul class="useful-links">
                        <li><a href="{{ route('home') }}">Página Principal</a></li>

                        @if ($global_page->terms_status == 1)
                            <li><a href="{{ route('terms') }}">Termos e condições</a></li>
                        @endif

                        @if ($global_page->privacy_status == 1)
                            <li><a href="{{ route('privacy') }}">Política de Privacidade</a></li>
                        @endif

                        @if ($global_page->faq_status == 1)
                            <li><a href="{{ route('faq') }}">Perguntas Frequentes</a></li>
                        @endif

                    </ul>
                </div>
            </div>


            <div class="col-md-3">
                <div class="item">
                    <h2 class="heading">Contato</h2>
                    <div class="list-item">
                        <div class="left">
                            <i class="fa fa-map-marker"></i>
                        </div>
                        <div class="right">
                            Rua Bartolomeu de Gusmão - Centro,
                            Foz do Iguaçu - PR, 85851-160
                        </div>
                    </div>
                    <div class="list-item">
                        <div class="left">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <div class="right">
                            <a href="https://wa.me/5545999510002" target="_blank">
                                +55 (45) 99951-0002
                            </a>
                        </div>
                    </div>
                    <div class="list-item">
                        <div class="left">
                            <i class="fa fa-envelope-o"></i>
                        </div>
                        <div class="right">
                            reservas@igucacuplazahotel.com.br
                        </div>
                    </div>
                    <ul class="social">
                        <li><a href=""><i class="fa fa-facebook-f"></i></a></li>
                        <li><a href=""><i class="fa fa-twitter"></i></a></li>
                        <li><a href=""><i class="fa fa-pinterest-p"></i></a></li>
                        <li><a href=""><i class="fa fa-linkedin"></i></a></li>
                        <li><a href=""><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-3">
                <div class="item">
                    <h2 class="heading">Newsletter</h2>
                    <p>
                        🌴 Descubra a beleza das Cataratas do Iguaçu em grande estilo! Inscreva-se na nossa Newsletter
                        para receber ofertas exclusivas, dicas de viagem e atualizações sobre nosso hotel econômico em
                        Foz do Iguaçu. Não perca essa oportunidade, junte-se a nós! 🏨✨ </p>
                    <form action="{{ route('subscriber_send_email') }}" method="post" class="form_subscribe_ajax">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="email" class="form-control">
                            <span class="text_danger error-text email_error"></span>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Inscreva-se agora!">
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="copyright">
    Copyright 2023, Desenvolvido por Lucas Bogo
</div>

<div class="scroll-top">
    <i class="fa fa-angle-up"></i>
</div>

<script>
    (function($) {
        $(".form_subscribe_ajax").on('submit', function(e) {
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
