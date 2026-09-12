@extends('frontend.layouts.layout')

@section('content')
        <header class="site-header parallax-bg">
            <div class="container">
                <div class="row d-flex align-items-center">
                    <div class="col-sm-8">
                        <h2 class="title">{{ __('ui.testimonial.page_title') }}</h2>
                    </div>
                    <div class="col-sm-4">
                        <div class="breadcrumbs">
                            <ul>
                                <li><a href="{{ url('/') }}">{{ __('ui.breadcrumbs.home') }}</a></li>
                                <li>{{ __('ui.testimonial.page_title') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <section class="contact-area section-padding" id="testimonial-submit-page">
            <div class="container">
                @if($about?->image)
                    <div class="row justify-content-center">
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <figure class="about-image mx-auto" style="margin-right:0; margin-bottom:30px; max-width:220px;">
                                <img src="{{asset($about->image)}}" alt="{{ $about->title }}" loading="lazy" decoding="async">
                            </figure>
                        </div>
                    </div>
                @endif

                <div class="row">
                    <div class="col-lg-6 offset-lg-3 text-center">
                        <div class="section-title">
                            <div class="desc">
                                <p>{{ __('ui.testimonial.page_subtitle') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <form class="contact-form" id="testimonial-form">
                            {{-- Honeypot: real visitors never see or fill this --}}
                            <div style="position:absolute;left:-9999px;" aria-hidden="true">
                                <input type="text" name="website" tabindex="-1" autocomplete="off">
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-box">
                                        <input type="text" name="name" id="testimonial-name" class="input-box" placeholder="{{ __('ui.testimonial.name') }}" maxlength="50" required>
                                        <label for="testimonial-name" class="icon lb-name"><i class="fal fa-user"></i></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-box">
                                        <input type="text" name="role" id="testimonial-role" class="input-box" placeholder="{{ __('ui.testimonial.role') }}" maxlength="100">
                                        <label for="testimonial-role" class="icon lb-subject"><i class="fal fa-briefcase"></i></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-box">
                                        <input type="text" name="company" id="testimonial-company" class="input-box" placeholder="{{ __('ui.testimonial.company') }}" maxlength="100">
                                        <label for="testimonial-company" class="icon lb-subject"><i class="fal fa-building"></i></label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-box">
                                        <textarea class="input-box" id="testimonial-message" placeholder="{{ __('ui.testimonial.message') }}" cols="30" rows="4" name="description" maxlength="1000" required></textarea>
                                        <label for="testimonial-message" class="icon lb-message"><i class="fal fa-edit"></i></label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-box">
                                        <button class="button-primary mouse-dir" type="submit" id="testimonial_submit_btn">
                                            {{ __('ui.testimonial.submit') }} <span class="dir-part"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

@push('scripts')
    <script src="{{ 'https://' . config('recaptcha.api_domain', 'www.google.com') . '/recaptcha/api.js?render=' . config('recaptcha.api_site_key') }}"></script>
    <script>
        $(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('submit', '#testimonial-form', function (e) {
        e.preventDefault();

        grecaptcha.ready(function () {
            grecaptcha.execute(@json(config('recaptcha.api_site_key')), { action: 'testimonial' }).then(function (token) {

                $('#testimonial-form').find('input[name="g-recaptcha-response"]').remove();

                $('<input>').attr({
                    type: 'hidden',
                    name: 'g-recaptcha-response',
                    value: token
                }).appendTo('#testimonial-form');

                $.ajax({
                    type: "POST",
                    url: "{{ route('testimonial.store') }}",
                    data: $('#testimonial-form').serialize(),
                    beforeSend: function () {
                        $('#testimonial_submit_btn').prop("disabled", true).text('...');
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                            $('#testimonial-form').trigger('reset');
                        }
                        $('#testimonial_submit_btn').prop("disabled", false).text("{{ __('ui.testimonial.submit') }}");
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            let errors = $.parseJSON(xhr.responseText);
                            $.each(errors.errors, function (key, val) {
                                toastr.error(val[0]);
                            });
                        } else {
                            toastr.error('Something went wrong. Please try again.');
                        }
                        $('#testimonial_submit_btn').prop("disabled", false).text("{{ __('ui.testimonial.submit') }}");
                    }
                });
            });
        });
    });

});
    </script>
@endpush
@endsection
