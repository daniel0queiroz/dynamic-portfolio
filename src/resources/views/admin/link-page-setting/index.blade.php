@extends('admin.layouts.layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="javascript:history.back()" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Links Page Settings</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">Links Page Settings</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Profile &amp; Default Language</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.link-page-setting.update', $setting->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Profile Name</label>
                                    <div class="col-sm-12 col-md-7">
                                        <small class="text-muted">English <span class="text-danger">*</span></small>
                                        <input type="text" name="profile_name[en]" class="form-control mb-2"
                                            value="{{ $setting->getTranslation('profile_name', 'en', false) }}">
                                        <small class="text-muted">Español</small>
                                        <input type="text" name="profile_name[es]" class="form-control mb-2"
                                            value="{{ $setting->getTranslation('profile_name', 'es', false) }}">
                                        <small class="text-muted">Português</small>
                                        <input type="text" name="profile_name[pt]" class="form-control"
                                            value="{{ $setting->getTranslation('profile_name', 'pt', false) }}">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Profile Bio</label>
                                    <div class="col-sm-12 col-md-7">
                                        <small class="text-muted">English <span class="text-danger">*</span></small>
                                        <input type="text" name="profile_bio[en]" class="form-control mb-2"
                                            value="{{ $setting->getTranslation('profile_bio', 'en', false) }}">
                                        <small class="text-muted">Español</small>
                                        <input type="text" name="profile_bio[es]" class="form-control mb-2"
                                            value="{{ $setting->getTranslation('profile_bio', 'es', false) }}">
                                        <small class="text-muted">Português</small>
                                        <input type="text" name="profile_bio[pt]" class="form-control"
                                            value="{{ $setting->getTranslation('profile_bio', 'pt', false) }}">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Default Language</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="default_locale" class="form-control selectric">
                                            <option value="en" {{ $setting->default_locale === 'en' ? 'selected' : '' }}>English</option>
                                            <option value="es" {{ $setting->default_locale === 'es' ? 'selected' : '' }}>Español</option>
                                            <option value="pt" {{ $setting->default_locale === 'pt' ? 'selected' : '' }}>Português</option>
                                        </select>
                                        <small class="text-muted">
                                            New visitors to <strong>/links</strong> will see this language by default.
                                            Visitors who have already switched language keep their own preference.
                                        </small>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary">Save Settings</button>
                                        <a href="{{ url('/links') }}" target="_blank" class="btn btn-info ml-2">
                                            Preview Page <i class="fas fa-external-link-alt"></i>
                                        </a>
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
