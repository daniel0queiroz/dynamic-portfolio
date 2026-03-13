@extends('admin.layouts.layout')

@section('content')
    <section class="section">
          <div class="section-header">
            <div class="section-header-back">
              <a href="javascript:history.back()" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Footer Information</h1>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Update Footer Info</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.footer-info.update', 1)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Info</label>
                            <div class="col-sm-12 col-md-7">
                                <small class="text-muted">English <span class="text-danger">*</span></small>
                                <textarea name="info[en]" class="form-control mb-2" style="height: 80px">{{$footerInfo?->getTranslation('info','en',false)}}</textarea>
                                <small class="text-muted">Español</small>
                                <textarea name="info[es]" class="form-control mb-2" style="height: 80px">{{$footerInfo?->getTranslation('info','es',false)}}</textarea>
                                <small class="text-muted">Português</small>
                                <textarea name="info[pt]" class="form-control" style="height: 80px">{{$footerInfo?->getTranslation('info','pt',false)}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Copy Right</label>
                            <div class="col-sm-12 col-md-7">
                                <small class="text-muted">English <span class="text-danger">*</span></small>
                                <input type="text" name="copy_right[en]" class="form-control mb-2" value="{{$footerInfo?->getTranslation('copy_right','en',false)}}">
                                <small class="text-muted">Español</small>
                                <input type="text" name="copy_right[es]" class="form-control mb-2" value="{{$footerInfo?->getTranslation('copy_right','es',false)}}">
                                <small class="text-muted">Português</small>
                                <input type="text" name="copy_right[pt]" class="form-control" value="{{$footerInfo?->getTranslation('copy_right','pt',false)}}">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Powered by</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="powered_by" class="form-control" value="{{$footerInfo?->powered_by}}">
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