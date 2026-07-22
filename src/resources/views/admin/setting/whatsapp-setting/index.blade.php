@extends('admin.layouts.layout')

@section('content')
    <section class="section">
          <div class="section-header">
            <div class="section-header-back">
              <a href="javascript:history.back()" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>WhatsApp Button Setting</h1>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Update Setting</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.whatsapp-setting.update', $setting->id)}}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Enabled --}}
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                            <div class="col-sm-12 col-md-7">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="is_enabled" value="1" class="custom-control-input" id="isEnabled" {{ old('is_enabled', $setting->is_enabled) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="isEnabled">Show the floating WhatsApp button on the site</label>
                                </div>
                            </div>
                        </div>

                        {{-- Phone number --}}
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">WhatsApp Number</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="phone_number" class="form-control" placeholder="+55 11 91234-5678" value="{{ old('phone_number', $setting->phone_number) }}">
                                <small class="text-muted">Include the country code. Formatting characters are ignored when building the link.</small>
                            </div>
                        </div>

                        {{-- Pre-filled message --}}
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pre-filled Message</label>
                            <div class="col-sm-12 col-md-7">
                                <small class="text-muted">English</small>
                                <textarea name="message[en]" class="form-control mb-2" rows="2">{{ old('message.en', $setting->getTranslation('message', 'en', false)) }}</textarea>
                                <small class="text-muted">Español</small>
                                <textarea name="message[es]" class="form-control mb-2" rows="2">{{ old('message.es', $setting->getTranslation('message', 'es', false)) }}</textarea>
                                <small class="text-muted">Português</small>
                                <textarea name="message[pt]" class="form-control" rows="2">{{ old('message.pt', $setting->getTranslation('message', 'pt', false)) }}</textarea>
                                <small class="text-muted d-block mt-1">Text that will be pre-filled in WhatsApp when a visitor taps the button, based on the page's language.</small>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                            <button class="btn btn-primary">Update</button>
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
