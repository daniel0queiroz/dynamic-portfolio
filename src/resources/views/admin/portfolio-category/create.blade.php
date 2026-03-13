@extends('admin.layouts.layout')

@section('content')
    <section class="section">
          <div class="section-header">
            <div class="section-header-back">
              <a href="javascript:history.back()" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Category</h1>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Create Category</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.category.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                            <div class="col-sm-12 col-md-7">
                                <small class="text-muted">English <span class="text-danger">*</span></small>
                                <input type="text" name="name[en]" class="form-control mb-2">
                                <small class="text-muted">Español</small>
                                <input type="text" name="name[es]" class="form-control mb-2">
                                <small class="text-muted">Português</small>
                                <input type="text" name="name[pt]" class="form-control">
                            </div>
                        </div>
                        
                        </div>
                        <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button class="btn btn-primary">Create</button>
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