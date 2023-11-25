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
                                                <label class="form-label">Existing Logo</label>
                                                <div>
                                                    <img src="{{ asset('uploads/' . $settings->logo) }}" alt=""
                                                        class="w_200">
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <label class="form-label">Change Logo</label>
                                                <div>
                                                    <input type="file" name="logo">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label class="form-label">Existing Favicon</label>
                                                <div>
                                                    <img src="{{ asset('uploads/' . $settings->favicon) }}" alt=""
                                                        class="w_50">
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <label class="form-label">Change Favicon</label>
                                                <div>
                                                    <input type="file" name="favicon">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Top Bar Phone</label>
                                        <input type="text" class="form-control" name="top_bar_phone"
                                            value="{{ $settings->top_bar_phone }}">
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Top Bar Email</label>
                                        <input type="text" class="form-control" name="top_bar_email"
                                            value="{{ $settings->top_bar_email }}">
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Home Feature Status</label>
                                        <select name="home_feature_status" class="form-control">
                                            <option value="Show" @if ($settings->home_feature_status == 'Show') selected @endif>Show
                                            </option>
                                            <option value="Hide" @if ($settings->home_feature_status == 'Hide') selected @endif>Hide
                                            </option>
                                        </select>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Home Room Total</label>
                                        <input type="text" class="form-control" name="home_room_total"
                                            value="{{ $settings->home_room_total }}">
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Home Room Status</label>
                                        <select name="home_room_status" class="form-control">
                                            <option value="Show" @if ($settings->home_room_status == 'Show') selected @endif>Show
                                            </option>
                                            <option value="Hide" @if ($settings->home_room_status == 'Hide') selected @endif>Hide
                                            </option>
                                        </select>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Home Testimonial Status</label>
                                        <select name="home_testimonial_status" class="form-control">
                                            <option value="Show" @if ($settings->home_testimonial_status == 'Show') selected @endif>Show
                                            </option>
                                            <option value="Hide" @if ($settings->home_testimonial_status == 'Hide') selected @endif>Hide
                                            </option>
                                        </select>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Home Latest Post Total</label>
                                        <input type="text" class="form-control" name="home_latest_post_total"
                                            value="{{ $settings->home_latest_post_total }}">
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Home Latest Post Status</label>
                                        <select name="home_latest_post_status" class="form-control">
                                            <option value="Show" @if ($settings->home_latest_post_status == 'Show') selected @endif>Show
                                            </option>
                                            <option value="Hide" @if ($settings->home_latest_post_status == 'Hide') selected @endif>Hide
                                            </option>
                                        </select>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Footer Address</label>
                                        <textarea name="footer_address" class="form-control h_100" cols="30" rows="10">{{ $settings->footer_address }}</textarea>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Footer Phone</label>
                                        <input type="text" class="form-control" name="footer_phone"
                                            value="{{ $settings->footer_phone }}">
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Footer Email</label>
                                        <input type="text" class="form-control" name="footer_email"
                                            value="{{ $settings->footer_email }}">
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Copyright Text</label>
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
                                        <input type="text" class="form-control" name="theme_color_1"
                                            value="{{ $settings->theme_color_1 }}">
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Cor do Tema 2</label>
                                        <input type="text" class="form-control" name="theme_color_2"
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
