@extends('admin.layouts.layout')

@section('content')
    <section class="section">
          <div class="section-header">
            <div class="section-header-back">
              <a href="javascript:history.back()" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>About Section</h1>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Update About Section</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.about.update', 1)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image</label>
                            <div class="col-sm-12 col-md-7">
                                <div id="image-preview" class="image-preview">
                                <label for="image-upload" id="image-label">Choose File</label>
                                <input type="file" name="image" id="image-upload" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                            <div class="col-sm-12 col-md-7">
                                <small class="text-muted">English <span class="text-danger">*</span></small>
                                <input type="text" name="title[en]" class="form-control mb-2" value="{{$about?->getTranslation('title','en',false)}}">
                                <small class="text-muted">Español</small>
                                <input type="text" name="title[es]" class="form-control mb-2" value="{{$about?->getTranslation('title','es',false)}}">
                                <small class="text-muted">Português</small>
                                <input type="text" name="title[pt]" class="form-control" value="{{$about?->getTranslation('title','pt',false)}}">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Description</label>
                            <div class="col-sm-12 col-md-7">
                                <small class="text-muted">English <span class="text-danger">*</span></small>
                                <textarea name="description[en]" class="summernote mb-3">{!! $about?->getTranslation('description','en',false) !!}</textarea>
                                <small class="text-muted">Español</small>
                                <textarea name="description[es]" class="summernote mb-3">{!! $about?->getTranslation('description','es',false) !!}</textarea>
                                <small class="text-muted">Português</small>
                                <textarea name="description[pt]" class="summernote">{!! $about?->getTranslation('description','pt',false) !!}</textarea>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Resume</label>
                            <div class="col-sm-12 col-md-7">
                                <small class="text-muted">English <span class="text-danger">*</span></small>
                                <div class="d-flex align-items-center mb-2">
                                    @if ($about?->resume)
                                        <i class="fas fa-file-pdf text-danger mr-2"></i>
                                        <small class="text-muted mr-3">Current file uploaded</small>
                                    @endif
                                    <input name="resume" type="file" class="form-control-file">
                                </div>
                                <small class="text-muted">Español</small>
                                <div class="d-flex align-items-center mb-2">
                                    @if ($about?->resume_es)
                                        <i class="fas fa-file-pdf text-danger mr-2"></i>
                                        <small class="text-muted mr-3">Current file uploaded</small>
                                    @endif
                                    <input name="resume_es" type="file" class="form-control-file">
                                </div>
                                <small class="text-muted">Português</small>
                                <div class="d-flex align-items-center">
                                    @if ($about?->resume_pt)
                                        <i class="fas fa-file-pdf text-danger mr-2"></i>
                                        <small class="text-muted mr-3">Current file uploaded</small>
                                    @endif
                                    <input name="resume_pt" type="file" class="form-control-file">
                                </div>
                            </div>
                        </div>
                        
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

@push('scripts')
    <script>
        $(document).ready(function(){
            $('#image-preview').css({
                'background-image': 'url("{{asset($about?->image)}}")',
                'background-size': 'cover',
               ' background-position': 'center center'
            })
        })
    </script>
@endpush