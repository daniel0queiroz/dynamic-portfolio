@extends('admin.layouts.layout')

@section('content')
    <section class="section">
          <div class="section-header">
            <div class="section-header-back">
              <a href="javascript:history.back()" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Feedback Section</h1>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Edit Feedback</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.feedback.update', $feedback->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                            <div class="col-sm-12 col-md-7">
                                <small class="text-muted">English <span class="text-danger">*</span></small>
                                <input type="text" name="name[en]" class="form-control mb-2" value="{{$feedback->getTranslation('name','en',false)}}">
                                <small class="text-muted">Español</small>
                                <input type="text" name="name[es]" class="form-control mb-2" value="{{$feedback->getTranslation('name','es',false)}}">
                                <small class="text-muted">Português</small>
                                <input type="text" name="name[pt]" class="form-control" value="{{$feedback->getTranslation('name','pt',false)}}">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Position</label>
                            <div class="col-sm-12 col-md-7">
                                <small class="text-muted">English</small>
                                <input type="text" name="position[en]" class="form-control mb-2" value="{{$feedback->getTranslation('position','en',false)}}">
                                <small class="text-muted">Español</small>
                                <input type="text" name="position[es]" class="form-control mb-2" value="{{$feedback->getTranslation('position','es',false)}}">
                                <small class="text-muted">Português</small>
                                <input type="text" name="position[pt]" class="form-control" value="{{$feedback->getTranslation('position','pt',false)}}">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Description</label>
                            <div class="col-sm-12 col-md-7">
                                <small class="text-muted">English <span class="text-danger">*</span></small>
                                <textarea name="description[en]" class="summernote mb-3">{!! $feedback->getTranslation('description','en',false) !!}</textarea>
                                <small class="text-muted">Español</small>
                                <textarea name="description[es]" class="summernote mb-3">{!! $feedback->getTranslation('description','es',false) !!}</textarea>
                                <small class="text-muted">Português</small>
                                <textarea name="description[pt]" class="summernote">{!! $feedback->getTranslation('description','pt',false) !!}</textarea>
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