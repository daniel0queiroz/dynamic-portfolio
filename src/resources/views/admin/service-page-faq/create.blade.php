@extends('admin.layouts.layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.service-page.edit', $page->id) }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Add FAQ — {{ $page->getTranslation('title', 'en', false) }}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>New FAQ</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.service-page-faq.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="service_page_id" value="{{ $page->id }}">

                                {{-- Question --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Question <span class="text-danger">*</span></label>
                                    <div class="col-sm-12 col-md-7">
                                        <small class="text-muted">English <span class="text-danger">*</span></small>
                                        <input type="text" name="question[en]" class="form-control mb-2" value="{{ old('question.en') }}">
                                        <small class="text-muted">Español</small>
                                        <input type="text" name="question[es]" class="form-control mb-2" value="{{ old('question.es') }}">
                                        <small class="text-muted">Português</small>
                                        <input type="text" name="question[pt]" class="form-control" value="{{ old('question.pt') }}">
                                    </div>
                                </div>

                                {{-- Answer --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Answer <span class="text-danger">*</span></label>
                                    <div class="col-sm-12 col-md-7">
                                        <small class="text-muted">English <span class="text-danger">*</span></small>
                                        <textarea name="answer[en]" class="form-control mb-2" style="height:120px">{{ old('answer.en') }}</textarea>
                                        <small class="text-muted">Español</small>
                                        <textarea name="answer[es]" class="form-control mb-2" style="height:120px">{{ old('answer.es') }}</textarea>
                                        <small class="text-muted">Português</small>
                                        <textarea name="answer[pt]" class="form-control" style="height:120px">{{ old('answer.pt') }}</textarea>
                                    </div>
                                </div>

                                {{-- Sort Order --}}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Sort Order</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}" min="0">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary">Add FAQ</button>
                                        <a href="{{ route('admin.service-page.edit', $page->id) }}" class="btn btn-secondary ml-2">Cancel</a>
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
