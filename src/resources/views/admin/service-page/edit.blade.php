@extends('admin.layouts.layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.service-page.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Landing Pages</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ url('service/' . $page->slug) }}" target="_blank" class="btn btn-info btn-sm ml-3">
                    <i class="fas fa-external-link-alt"></i> View Page
                </a>
            </div>
        </div>

        <div class="section-body">

            {{-- Page Settings --}}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Landing Page</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.service-page.update', $page->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- Preserve Lead Form Config / section toggles when only saving page settings --}}
                                <input type="hidden" name="form_title[en]" value="{{ $page->getTranslation('form_title', 'en', false) }}">
                                <input type="hidden" name="form_title[es]" value="{{ $page->getTranslation('form_title', 'es', false) }}">
                                <input type="hidden" name="form_title[pt]" value="{{ $page->getTranslation('form_title', 'pt', false) }}">
                                <input type="hidden" name="form_subtitle[en]" value="{{ $page->getTranslation('form_subtitle', 'en', false) }}">
                                <input type="hidden" name="form_subtitle[es]" value="{{ $page->getTranslation('form_subtitle', 'es', false) }}">
                                <input type="hidden" name="form_subtitle[pt]" value="{{ $page->getTranslation('form_subtitle', 'pt', false) }}">
                                <input type="hidden" name="cta_label[en]" value="{{ $page->getTranslation('cta_label', 'en', false) }}">
                                <input type="hidden" name="cta_label[es]" value="{{ $page->getTranslation('cta_label', 'es', false) }}">
                                <input type="hidden" name="cta_label[pt]" value="{{ $page->getTranslation('cta_label', 'pt', false) }}">
                                <input type="hidden" name="form_success_message[en]" value="{{ $page->getTranslation('form_success_message', 'en', false) }}">
                                <input type="hidden" name="form_success_message[es]" value="{{ $page->getTranslation('form_success_message', 'es', false) }}">
                                <input type="hidden" name="form_success_message[pt]" value="{{ $page->getTranslation('form_success_message', 'pt', false) }}">
                                <input type="hidden" name="lead_form_enabled" value="{{ $page->lead_form_enabled ? 1 : 0 }}">
                                <input type="hidden" name="faq_enabled" value="{{ $page->faq_enabled ? 1 : 0 }}">

                                {{-- Slug --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                        Slug <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="slug" class="form-control" value="{{ old('slug', $page->slug) }}">
                                        <small class="text-muted">Page URL: <a href="{{ url('service/' . $page->slug) }}" target="_blank">{{ url('service/' . $page->slug) }}</a></small>
                                    </div>
                                </div>

                                {{-- Title --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title <span class="text-danger">*</span></label>
                                    <div class="col-sm-12 col-md-7">
                                        <small class="text-muted">English <span class="text-danger">*</span></small>
                                        <input type="text" name="title[en]" class="form-control mb-2" value="{{ old('title.en', $page->getTranslation('title', 'en', false)) }}">
                                        <small class="text-muted">Español</small>
                                        <input type="text" name="title[es]" class="form-control mb-2" value="{{ old('title.es', $page->getTranslation('title', 'es', false)) }}">
                                        <small class="text-muted">Português</small>
                                        <input type="text" name="title[pt]" class="form-control" value="{{ old('title.pt', $page->getTranslation('title', 'pt', false)) }}">
                                    </div>
                                </div>

                                {{-- Subtitle / Copy --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Copy / Subtitle <span class="text-danger">*</span></label>
                                    <div class="col-sm-12 col-md-7">
                                        <small class="text-muted">English <span class="text-danger">*</span></small>
                                        <textarea name="subtitle[en]" class="form-control mb-2" style="height:100px">{{ old('subtitle.en', $page->getTranslation('subtitle', 'en', false)) }}</textarea>
                                        <small class="text-muted">Español</small>
                                        <textarea name="subtitle[es]" class="form-control mb-2" style="height:100px">{{ old('subtitle.es', $page->getTranslation('subtitle', 'es', false)) }}</textarea>
                                        <small class="text-muted">Português</small>
                                        <textarea name="subtitle[pt]" class="form-control" style="height:100px">{{ old('subtitle.pt', $page->getTranslation('subtitle', 'pt', false)) }}</textarea>
                                    </div>
                                </div>

                                {{-- Desktop Image --}}
                                @if ($page->image)
                                    <div class="form-group row mb-2">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Current Desktop Image</label>
                                        <div class="col-sm-12 col-md-7">
                                            <img src="{{ asset($page->image) }}" alt="Desktop image" style="max-height:140px;border-radius:8px;" class="d-block mb-2">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="remove_image" value="1" class="custom-control-input" id="removeImage">
                                                <label class="custom-control-label text-danger" for="removeImage">Remove desktop image</label>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ $page->image ? 'Replace Desktop Image' : 'Desktop Image' }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="file" name="image" class="form-control" accept="image/*">
                                        <small class="text-muted">Hero background on desktop (≥ 768px). Landscape format recommended.</small>
                                    </div>
                                </div>

                                {{-- Mobile Image --}}
                                @if ($page->mobile_image)
                                    <div class="form-group row mb-2">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Current Mobile Image</label>
                                        <div class="col-sm-12 col-md-7">
                                            <img src="{{ asset($page->mobile_image) }}" alt="Mobile image" style="max-height:140px;border-radius:8px;" class="d-block mb-2">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="remove_mobile_image" value="1" class="custom-control-input" id="removeMobileImage">
                                                <label class="custom-control-label text-danger" for="removeMobileImage">Remove mobile image</label>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ $page->mobile_image ? 'Replace Mobile Image' : 'Mobile Image' }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="file" name="mobile_image" class="form-control" accept="image/*">
                                        <small class="text-muted">Hero background on mobile (&lt; 768px). Portrait format recommended. Falls back to desktop image if blank.</small>
                                    </div>
                                </div>

                                {{-- Video URL --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Video URL</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="url" name="video_url" class="form-control" placeholder="https://www.youtube.com/watch?v=..." value="{{ old('video_url', $page->video_url) }}">
                                        <small class="text-muted">YouTube or Vimeo URL. Leave blank to hide the video section.</small>
                                    </div>
                                </div>

                                {{-- Active --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="is_active" value="1" class="custom-control-input" id="isActive" {{ old('is_active', $page->is_active) ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="isActive">Active (page is publicly accessible)</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary">Update Page</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Form Config Section --}}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Lead Form Config</h4>
                            <div class="card-header-action">
                                <small class="text-muted">These texts appear in the form section at the bottom of the landing page.</small>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.service-page.update', $page->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                {{-- Pass through the other required fields as hidden so validation passes --}}
                                <input type="hidden" name="slug" value="{{ $page->slug }}">
                                <input type="hidden" name="title[en]" value="{{ $page->getTranslation('title', 'en', false) }}">
                                <input type="hidden" name="title[es]" value="{{ $page->getTranslation('title', 'es', false) }}">
                                <input type="hidden" name="title[pt]" value="{{ $page->getTranslation('title', 'pt', false) }}">
                                <input type="hidden" name="subtitle[en]" value="{{ $page->getTranslation('subtitle', 'en', false) }}">
                                <input type="hidden" name="subtitle[es]" value="{{ $page->getTranslation('subtitle', 'es', false) }}">
                                <input type="hidden" name="subtitle[pt]" value="{{ $page->getTranslation('subtitle', 'pt', false) }}">
                                <input type="hidden" name="video_url" value="{{ $page->video_url }}">
                                <input type="hidden" name="is_active" value="{{ $page->is_active ? 1 : 0 }}">
                                <input type="hidden" name="faq_enabled" value="{{ $page->faq_enabled ? 1 : 0 }}">

                                {{-- Enable Lead Form --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3">Lead Form</label>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="lead_form_enabled" value="1" class="custom-control-input" id="leadFormEnabled" {{ old('lead_form_enabled', $page->lead_form_enabled) ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="leadFormEnabled">Enable lead form section</label>
                                        </div>
                                        <small class="text-muted">When disabled, the form and its fields are hidden from the public page even if fields exist below.</small>
                                    </div>
                                </div>

                                <div id="leadFormFieldsGroup">
                                    {{-- CTA Label --}}
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3">CTA Button Label</label>
                                        <div class="col-sm-12 col-md-7">
                                            <small class="text-muted">English</small>
                                            <input type="text" name="cta_label[en]" class="form-control mb-2"
                                                   value="{{ old('cta_label.en', $page->getTranslation('cta_label', 'en', false)) }}"
                                                   placeholder="e.g. Get a free consultation">
                                            <small class="text-muted">Español</small>
                                            <input type="text" name="cta_label[es]" class="form-control mb-2"
                                                   value="{{ old('cta_label.es', $page->getTranslation('cta_label', 'es', false)) }}">
                                            <small class="text-muted">Português</small>
                                            <input type="text" name="cta_label[pt]" class="form-control"
                                                   value="{{ old('cta_label.pt', $page->getTranslation('cta_label', 'pt', false)) }}">
                                            <small class="text-muted d-block mt-1">Leave blank to hide the CTA button from the hero.</small>
                                        </div>
                                    </div>

                                    {{-- Form Title --}}
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3">Form Title</label>
                                        <div class="col-sm-12 col-md-7">
                                            <small class="text-muted">English</small>
                                            <input type="text" name="form_title[en]" class="form-control mb-2"
                                                   value="{{ old('form_title.en', $page->getTranslation('form_title', 'en', false)) }}"
                                                   placeholder="e.g. Let's talk about your project">
                                            <small class="text-muted">Español</small>
                                            <input type="text" name="form_title[es]" class="form-control mb-2"
                                                   value="{{ old('form_title.es', $page->getTranslation('form_title', 'es', false)) }}">
                                            <small class="text-muted">Português</small>
                                            <input type="text" name="form_title[pt]" class="form-control"
                                                   value="{{ old('form_title.pt', $page->getTranslation('form_title', 'pt', false)) }}">
                                        </div>
                                    </div>

                                    {{-- Form Subtitle --}}
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3">Form Subtitle</label>
                                        <div class="col-sm-12 col-md-7">
                                            <small class="text-muted">English</small>
                                            <input type="text" name="form_subtitle[en]" class="form-control mb-2"
                                                   value="{{ old('form_subtitle.en', $page->getTranslation('form_subtitle', 'en', false)) }}"
                                                   placeholder="e.g. Fill in and I'll get back to you shortly.">
                                            <small class="text-muted">Español</small>
                                            <input type="text" name="form_subtitle[es]" class="form-control mb-2"
                                                   value="{{ old('form_subtitle.es', $page->getTranslation('form_subtitle', 'es', false)) }}">
                                            <small class="text-muted">Português</small>
                                            <input type="text" name="form_subtitle[pt]" class="form-control"
                                                   value="{{ old('form_subtitle.pt', $page->getTranslation('form_subtitle', 'pt', false)) }}">
                                        </div>
                                    </div>

                                    {{-- Success Message --}}
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3">Success Message</label>
                                        <div class="col-sm-12 col-md-7">
                                            <small class="text-muted">English</small>
                                            <input type="text" name="form_success_message[en]" class="form-control mb-2"
                                                   value="{{ old('form_success_message.en', $page->getTranslation('form_success_message', 'en', false)) }}"
                                                   placeholder="e.g. Thank you! I'll reach out within 24 hours.">
                                            <small class="text-muted">Español</small>
                                            <input type="text" name="form_success_message[es]" class="form-control mb-2"
                                                   value="{{ old('form_success_message.es', $page->getTranslation('form_success_message', 'es', false)) }}">
                                            <small class="text-muted">Português</small>
                                            <input type="text" name="form_success_message[pt]" class="form-control"
                                                   value="{{ old('form_success_message.pt', $page->getTranslation('form_success_message', 'pt', false)) }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label text-md-right col-12 col-md-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary">Save Form Config</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Lead Form Fields Section --}}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                Form Fields
                                @if ($page->lead_form_enabled)
                                    <span class="badge badge-success ml-2">Section Enabled</span>
                                @else
                                    <span class="badge badge-secondary ml-2">Section Disabled</span>
                                @endif
                            </h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.lead-form-field.create', ['service_page_id' => $page->id]) }}" class="btn btn-success">
                                    Add Field <i class="fas fa-plus"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($page->leadFormFields->isEmpty())
                                <p class="text-muted">No form fields yet. Click "Add Field" to create one.</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Label (EN)</th>
                                                <th>Type</th>
                                                <th>Required</th>
                                                <th>Order</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($page->leadFormFields as $field)
                                                <tr>
                                                    <td>{{ $field->id }}</td>
                                                    <td>{{ $field->getTranslation('label', 'en', false) }}</td>
                                                    <td><span class="badge badge-info">{{ $field->type }}</span></td>
                                                    <td>{{ $field->is_required ? '<span class="badge badge-danger">Yes</span>' : '<span class="badge badge-secondary">No</span>' }}</td>
                                                    <td>{{ $field->sort_order }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('admin.lead-form-field.edit', $field->id) }}" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="{{ route('admin.lead-form-field.destroy', $field->id) }}" class="btn btn-sm btn-danger delete-item ml-1">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- FAQs Section --}}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                FAQ Items
                                @if ($page->faq_enabled)
                                    <span class="badge badge-success ml-2">Section Enabled</span>
                                @else
                                    <span class="badge badge-secondary ml-2">Section Disabled</span>
                                @endif
                            </h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.service-page-faq.create', ['service_page_id' => $page->id]) }}" class="btn btn-success">
                                    Add FAQ <i class="fas fa-plus"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.service-page.update', $page->id) }}" method="POST" class="mb-4">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="slug" value="{{ $page->slug }}">
                                <input type="hidden" name="title[en]" value="{{ $page->getTranslation('title', 'en', false) }}">
                                <input type="hidden" name="title[es]" value="{{ $page->getTranslation('title', 'es', false) }}">
                                <input type="hidden" name="title[pt]" value="{{ $page->getTranslation('title', 'pt', false) }}">
                                <input type="hidden" name="subtitle[en]" value="{{ $page->getTranslation('subtitle', 'en', false) }}">
                                <input type="hidden" name="subtitle[es]" value="{{ $page->getTranslation('subtitle', 'es', false) }}">
                                <input type="hidden" name="subtitle[pt]" value="{{ $page->getTranslation('subtitle', 'pt', false) }}">
                                <input type="hidden" name="video_url" value="{{ $page->video_url }}">
                                <input type="hidden" name="is_active" value="{{ $page->is_active ? 1 : 0 }}">
                                <input type="hidden" name="form_title[en]" value="{{ $page->getTranslation('form_title', 'en', false) }}">
                                <input type="hidden" name="form_title[es]" value="{{ $page->getTranslation('form_title', 'es', false) }}">
                                <input type="hidden" name="form_title[pt]" value="{{ $page->getTranslation('form_title', 'pt', false) }}">
                                <input type="hidden" name="form_subtitle[en]" value="{{ $page->getTranslation('form_subtitle', 'en', false) }}">
                                <input type="hidden" name="form_subtitle[es]" value="{{ $page->getTranslation('form_subtitle', 'es', false) }}">
                                <input type="hidden" name="form_subtitle[pt]" value="{{ $page->getTranslation('form_subtitle', 'pt', false) }}">
                                <input type="hidden" name="cta_label[en]" value="{{ $page->getTranslation('cta_label', 'en', false) }}">
                                <input type="hidden" name="cta_label[es]" value="{{ $page->getTranslation('cta_label', 'es', false) }}">
                                <input type="hidden" name="cta_label[pt]" value="{{ $page->getTranslation('cta_label', 'pt', false) }}">
                                <input type="hidden" name="form_success_message[en]" value="{{ $page->getTranslation('form_success_message', 'en', false) }}">
                                <input type="hidden" name="form_success_message[es]" value="{{ $page->getTranslation('form_success_message', 'es', false) }}">
                                <input type="hidden" name="form_success_message[pt]" value="{{ $page->getTranslation('form_success_message', 'pt', false) }}">
                                <input type="hidden" name="lead_form_enabled" value="{{ $page->lead_form_enabled ? 1 : 0 }}">

                                <div class="custom-control custom-switch d-inline-block mr-3">
                                    <input type="checkbox" name="faq_enabled" value="1" class="custom-control-input" id="faqEnabled" {{ old('faq_enabled', $page->faq_enabled) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="faqEnabled">Enable FAQ section on the public page</label>
                                </div>
                                <button class="btn btn-sm btn-primary">Save</button>
                            </form>

                            @if ($page->faqs->isEmpty())
                                <p class="text-muted">No FAQs yet. Click "Add FAQ" to create one.</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Question (EN)</th>
                                                <th>Order</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($page->faqs as $faq)
                                                <tr>
                                                    <td>{{ $faq->id }}</td>
                                                    <td>{{ $faq->getTranslation('question', 'en', false) }}</td>
                                                    <td>{{ $faq->sort_order }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('admin.service-page-faq.edit', $faq->id) }}" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="{{ route('admin.service-page-faq.destroy', $faq->id) }}" class="btn btn-sm btn-danger delete-item ml-1">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
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
    </script>
@endsection
