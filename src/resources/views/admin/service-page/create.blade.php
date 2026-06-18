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
@endsection
