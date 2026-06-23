@extends('admin.layouts.layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.service-page.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Landing Pages</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Landing Page</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.service-page.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                {{-- Slug --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                        Slug <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="slug" class="form-control" placeholder="service1" value="{{ old('slug') }}">
                                        <small class="text-muted">Lowercase letters, numbers, and hyphens only. The page will be at <code>/service/{slug}</code>.</small>
                                    </div>
                                </div>

                                {{-- Title --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title <span class="text-danger">*</span></label>
                                    <div class="col-sm-12 col-md-7">
                                        <small class="text-muted">English <span class="text-danger">*</span></small>
                                        <input type="text" name="title[en]" class="form-control mb-2" value="{{ old('title.en') }}">
                                        <small class="text-muted">Español</small>
                                        <input type="text" name="title[es]" class="form-control mb-2" value="{{ old('title.es') }}">
                                        <small class="text-muted">Português</small>
                                        <input type="text" name="title[pt]" class="form-control" value="{{ old('title.pt') }}">
                                    </div>
                                </div>

                                {{-- Subtitle / Copy --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Copy / Subtitle <span class="text-danger">*</span></label>
                                    <div class="col-sm-12 col-md-7">
                                        <small class="text-muted">English <span class="text-danger">*</span></small>
                                        <textarea name="subtitle[en]" class="form-control mb-2" style="height:100px">{{ old('subtitle.en') }}</textarea>
                                        <small class="text-muted">Español</small>
                                        <textarea name="subtitle[es]" class="form-control mb-2" style="height:100px">{{ old('subtitle.es') }}</textarea>
                                        <small class="text-muted">Português</small>
                                        <textarea name="subtitle[pt]" class="form-control" style="height:100px">{{ old('subtitle.pt') }}</textarea>
                                    </div>
                                </div>

                                {{-- Desktop Image --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Desktop Image</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="file" name="image" class="form-control" accept="image/*">
                                        <small class="text-muted">Hero background on desktop (≥ 768px). Landscape format recommended.</small>
                                    </div>
                                </div>

                                {{-- Mobile Image --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Mobile Image</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="file" name="mobile_image" class="form-control" accept="image/*">
                                        <small class="text-muted">Hero background on mobile (&lt; 768px). Portrait format recommended. Falls back to desktop image if left blank.</small>
                                    </div>
                                </div>

                                {{-- Video URL --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Video URL</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="url" name="video_url" class="form-control" placeholder="https://www.youtube.com/watch?v=..." value="{{ old('video_url') }}">
                                        <small class="text-muted">YouTube or Vimeo URL. Will be embedded as the main video section.</small>
                                    </div>
                                </div>

                                {{-- Active --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="is_active" value="1" class="custom-control-input" id="isActive" {{ old('is_active', '1') ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="isActive">Active (page is publicly accessible)</label>
                                        </div>
                                    </div>
                                </div>

                                <hr class="mb-4">

                                {{-- Enable Lead Form --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Lead Form</label>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="lead_form_enabled" value="1" class="custom-control-input" id="leadFormEnabled" {{ old('lead_form_enabled', '1') ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="leadFormEnabled">Enable lead form section</label>
                                        </div>
                                        <small class="text-muted">Shows the contact/lead capture form at the bottom of the page.</small>
                                    </div>
                                </div>

                                <div id="leadFormFieldsGroup">
                                    {{-- CTA Label --}}
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">CTA Button Label</label>
                                        <div class="col-sm-12 col-md-7">
                                            <small class="text-muted">English</small>
                                            <input type="text" name="cta_label[en]" class="form-control mb-2" value="{{ old('cta_label.en') }}" placeholder="e.g. Get a free consultation">
                                            <small class="text-muted">Español</small>
                                            <input type="text" name="cta_label[es]" class="form-control mb-2" value="{{ old('cta_label.es') }}">
                                            <small class="text-muted">Português</small>
                                            <input type="text" name="cta_label[pt]" class="form-control" value="{{ old('cta_label.pt') }}">
                                            <small class="text-muted d-block mt-1">Leave blank to hide the CTA button from the hero.</small>
                                        </div>
                                    </div>

                                    {{-- Form Title --}}
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Form Title</label>
                                        <div class="col-sm-12 col-md-7">
                                            <small class="text-muted">English</small>
                                            <input type="text" name="form_title[en]" class="form-control mb-2" value="{{ old('form_title.en') }}" placeholder="e.g. Let's talk about your project">
                                            <small class="text-muted">Español</small>
                                            <input type="text" name="form_title[es]" class="form-control mb-2" value="{{ old('form_title.es') }}">
                                            <small class="text-muted">Português</small>
                                            <input type="text" name="form_title[pt]" class="form-control" value="{{ old('form_title.pt') }}">
                                        </div>
                                    </div>

                                    {{-- Form Subtitle --}}
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Form Subtitle</label>
                                        <div class="col-sm-12 col-md-7">
                                            <small class="text-muted">English</small>
                                            <input type="text" name="form_subtitle[en]" class="form-control mb-2" value="{{ old('form_subtitle.en') }}" placeholder="e.g. Fill in and I'll get back to you shortly.">
                                            <small class="text-muted">Español</small>
                                            <input type="text" name="form_subtitle[es]" class="form-control mb-2" value="{{ old('form_subtitle.es') }}">
                                            <small class="text-muted">Português</small>
                                            <input type="text" name="form_subtitle[pt]" class="form-control" value="{{ old('form_subtitle.pt') }}">
                                        </div>
                                    </div>

                                    {{-- Success Message --}}
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Success Message</label>
                                        <div class="col-sm-12 col-md-7">
                                            <small class="text-muted">English</small>
                                            <input type="text" name="form_success_message[en]" class="form-control mb-2" value="{{ old('form_success_message.en') }}" placeholder="e.g. Thank you! I'll reach out within 24 hours.">
                                            <small class="text-muted">Español</small>
                                            <input type="text" name="form_success_message[es]" class="form-control mb-2" value="{{ old('form_success_message.es') }}">
                                            <small class="text-muted">Português</small>
                                            <input type="text" name="form_success_message[pt]" class="form-control" value="{{ old('form_success_message.pt') }}">
                                        </div>
                                    </div>

                                    <p class="text-muted" style="max-width:600px;margin-left:calc(25% + 1px)">
                                        <i class="fas fa-info-circle"></i>
                                        Individual form fields can be added after you create the page.
                                    </p>
                                </div>

                                <hr class="mb-4">

                                {{-- Enable FAQ --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">FAQ Section</label>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="faq_enabled" value="1" class="custom-control-input" id="faqEnabled" {{ old('faq_enabled', '1') ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="faqEnabled">Enable FAQ section</label>
                                        </div>
                                        <small class="text-muted">Shows a frequently-asked-questions accordion on the page.</small>
                                    </div>
                                </div>

                                <div id="faqFieldsGroup">
                                    <p class="text-muted" style="max-width:600px;margin-left:calc(25% + 1px)">
                                        <i class="fas fa-info-circle"></i>
                                        Individual FAQ items can be added after you create the page.
                                    </p>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary">Create Page</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function bindSectionToggle(checkboxId, groupId) {
            var checkbox = document.getElementById(checkboxId);
            var group = document.getElementById(groupId);
            if (!checkbox || !group) return;
            var sync = function () { group.style.display = checkbox.checked ? '' : 'none'; };
            checkbox.addEventListener('change', sync);
            sync();
        }
        bindSectionToggle('leadFormEnabled', 'leadFormFieldsGroup');
        bindSectionToggle('faqEnabled', 'faqFieldsGroup');
    </script>
@endsection
