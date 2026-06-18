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

            {{-- FAQs Section --}}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>FAQ Items</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.service-page-faq.create', ['service_page_id' => $page->id]) }}" class="btn btn-success">
                                    Add FAQ <i class="fas fa-plus"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
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
@endsection
