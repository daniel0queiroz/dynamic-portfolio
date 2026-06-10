@extends('admin.layouts.layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="javascript:history.back()" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Link Item</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin.link-item.index') }}">Link Items</a></div>
                <div class="breadcrumb-item active">Create</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Link Item</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.link-item.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                        Thumbnail <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-12 col-md-7">
                                        <div id="image-preview" class="image-preview">
                                            <label for="image-upload" id="image-label">Choose File</label>
                                            <input type="file" name="thumbnail" id="image-upload" />
                                        </div>
                                        <small class="text-muted">Recommended: landscape image (e.g. 1200×600px)</small>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                                    <div class="col-sm-12 col-md-7">
                                        <small class="text-muted">English <span class="text-danger">*</span></small>
                                        <input type="text" name="name[en]" class="form-control mb-2" value="{{ old('name.en') }}">
                                        <small class="text-muted">Español</small>
                                        <input type="text" name="name[es]" class="form-control mb-2" value="{{ old('name.es') }}">
                                        <small class="text-muted">Português</small>
                                        <input type="text" name="name[pt]" class="form-control" value="{{ old('name.pt') }}">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                        URL <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="url" name="url" class="form-control" placeholder="https://..." value="{{ old('url') }}">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Sort Order</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}" min="0">
                                        <small class="text-muted">Lower number = displayed first</small>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Active</label>
                                    <div class="col-sm-12 col-md-7 d-flex align-items-center">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" checked>
                                            <label class="custom-control-label" for="is_active">Show on /links page</label>
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

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#image-preview').css({
                'background-image': 'url("")',
                'background-size': 'cover',
                'background-position': 'center center'
            });
        });
    </script>
@endpush
