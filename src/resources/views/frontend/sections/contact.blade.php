<section class="contact-area section-padding" id="contact-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 text-center">
                <div class="section-title">
                    <h3 class="title">{{ $contactTitle?->title }}</h3>
                    <div class="desc">
                        <p>{{ $contactTitle?->sub_title }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <!-- Contact-Form -->
                <form class="contact-form" id="contact-form">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-box">
                                <input type="text" name="name" id="form-name" class="input-box" placeholder="Name">
                                <label for="form-name" class="icon lb-name"><i class="fal fa-user"></i></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-box">
                                <input type="text" name="email" id="form-email" class="input-box" placeholder="Email">
                                <label for="form-email" class="icon lb-email"><i class="fal fa-envelope"></i></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-box">
                                <input type="text" name="subject" id="form-subject" class="input-box" placeholder="Subject">
                                <label for="form-subject" class="icon lb-subject"><i class="fal fa-check-square"></i></label>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-box">
                                <textarea class="input-box" id="form-message" placeholder="Message" cols="30" rows="4" name="message"></textarea>
                                <label for="form-message" class="icon lb-message"><i class="fal fa-edit"></i></label>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-box">
                                <button class="button-primary mouse-dir" type="submit" id="submit_btn">
                                    Send Now <span class="dir-part"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Contact-Form / -->
            </div>
        </div>
    </div>
</section>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {

    // Lazy-load reCAPTCHA only once the visitor reaches/interacts with the contact section,
    // instead of fetching it unconditionally on every homepage view.
    var recaptchaSiteKey = @json(config('recaptcha.api_site_key'));
    var recaptchaJsUrl = @json('https://' . config('recaptcha.api_domain', 'www.google.com') . '/recaptcha/api.js');
    var recaptchaLoadPromise = null;

    function loadRecaptcha() {
        if (!recaptchaLoadPromise) {
            recaptchaLoadPromise = new Promise(function (resolve) {
                var script = document.createElement('script');
                script.src = recaptchaJsUrl + '?render=' + recaptchaSiteKey;
                script.onload = resolve;
                document.body.appendChild(script);
            });
        }
        return recaptchaLoadPromise;
    }

    var contactSection = document.getElementById('contact-page');
    if (contactSection && 'IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    loadRecaptcha();
                    observer.disconnect();
                }
            });
        }, { rootMargin: '200px' });
        observer.observe(contactSection);
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('submit', '#contact-form', function (e) {
        e.preventDefault();

        loadRecaptcha().then(function () {
        grecaptcha.ready(function () {
            grecaptcha.execute(recaptchaSiteKey, { action: 'contact' }).then(function (token) {

                // remove previous token if any
                $('#contact-form').find('input[name="g-recaptcha-response"]').remove();

                // append the new token to the form
                $('<input>').attr({
                    type: 'hidden',
                    name: 'g-recaptcha-response',
                    value: token
                }).appendTo('#contact-form');

                console.log($('#contact-form').serialize());


                // send AJAX request
                $.ajax({
                    type: "POST",
                    url: "{{ route('contact') }}", // make sure your route exists
                    data: $('#contact-form').serialize(),
                    beforeSend: function () {
                        $('#submit_btn').prop("disabled", true).text('Loading...');
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                            $('#submit_btn').prop("disabled", false).text('Send Now');
                            $('#contact-form').trigger('reset');
                        }
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
                        $('#submit_btn').prop("disabled", false).text('Send Now');
                    }
                });
            });
        });
        });
    });

});

    </script>
@endpush
