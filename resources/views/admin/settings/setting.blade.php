@extends('admin.layout.master')

@section('heading', 'Setting')

@section('main_content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin_setting_update', $settings->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label class="form-label">Logo Existente</label>
                                                <div>
                                                    <img src="{{ asset('uploads/' . $settings->logo) }}" alt=""
                                                        class="w_200">
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <label class="form-label">Mudar Logo</label>
                                                <div>
                                                    <input type="file" name="logo">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label class="form-label">Favicon Existente</label>
                                                <div>
                                                    <img src="{{ asset('uploads/' . $settings->favicon) }}" alt=""
                                                        class="w_50">
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <label class="form-label">Mudar Favicon</label>
                                                <div>
                                                    <input type="file" name="favicon">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Numero WhatsApp (parte superior)</label>
                                        <input type="text" class="form-control" name="top_bar_whatsapp"
                                            value="{{ $settings->top_bar_whatsapp }}">
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Link do WhatsApp</label>
                                        <input type="url" class="form-control" name="top_bar_whatsapp_link"
                                            value="{{ $settings->top_bar_whatsapp_link }}">
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Numero de telefone (parte superior)</label>
                                        <input type="text" class="form-control" name="top_bar_phone"
                                            value="{{ $settings->top_bar_phone }}">
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Email (Parte Superior)</label>
                                        <input type="text" class="form-control" name="top_bar_email"
                                            value="{{ $settings->top_bar_email }}">
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Titulo/Nome do Hotel (parte inferior)</label>
                                        <input type="text" class="form-control" name="footer_hotel_title"
                                            value="{{ $settings->footer_hotel_title }}">
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Endereço (parte inferior)</label>
                                        <textarea name="footer_address" class="form-control h_100" cols="30" rows="10">{{ $settings->footer_address }}</textarea>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Numero WhatsApp (parte inferior)</label>
                                        <input type="text" class="form-control" name="footer_hotel_whatsapp"
                                            value="{{ $settings->footer_hotel_whatsapp }}">
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Link do WhatsApp (parte inferior)</label>
                                        <input type="url" class="form-control" name="footer_hotel_whatsapp_link"
                                            value="{{ $settings->footer_hotel_whatsapp_link }}">
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Telefone (parte inferior)</label>
                                        <input type="text" class="form-control" name="footer_phone"
                                            value="{{ $settings->footer_phone }}">
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">E-mail (parte inferior)</label>
                                        <input type="text" class="form-control" name="footer_email"
                                            value="{{ $settings->footer_email }}">
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label"> Texto Copyright</label>
                                        <input type="text" class="form-control" name="copyright"
                                            value="{{ $settings->copyright }}">
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Facebook</label>
                                        <input type="text" class="form-control" name="facebook"
                                            value="{{ $settings->facebook }}">
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Twitter</label>
                                        <input type="text" class="form-control" name="twitter"
                                            value="{{ $settings->twitter }}">
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">LinkedIn</label>
                                        <input type="text" class="form-control" name="linkedin"
                                            value="{{ $settings->linkedin }}">
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Pinterest</label>
                                        <input type="text" class="form-control" name="pinterest"
                                            value="{{ $settings->pinterest }}">
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">ID do Google Analytics</label>
                                        <input type="text" class="form-control" name="analytic_id"
                                            value="{{ $settings->analytic_id }}">
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Cor do Tema 1</label>
                                        <input type="color" class="form-control" name="theme_color_1"
                                            value="{{ $settings->theme_color_1 }}">
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Cor do Tema 2</label>
                                        <input type="color" class="form-control" name="theme_color_2"
                                            value="{{ $settings->theme_color_2 }}">
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
