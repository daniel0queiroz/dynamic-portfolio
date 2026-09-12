@extends('admin.layouts.layout')

@section('content')
    <section class="section">
          <div class="section-header">
            <div class="section-header-back">
              <a href="javascript:history.back()" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Feedback Section Setting</h1>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Update Section</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.feedback-section-setting.update',1)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                        <div class="col-sm-12 col-md-7">
                            <small class="text-muted">English <span class="text-danger">*</span></small>
                            <input type="text" name="title[en]" class="form-control mb-2" value="{{$feedbackTitle->getTranslation('title','en',false)}}">
                            <small class="text-muted">Español</small>
                            <input type="text" name="title[es]" class="form-control mb-2" value="{{$feedbackTitle->getTranslation('title','es',false)}}">
                            <small class="text-muted">Português</small>
                            <input type="text" name="title[pt]" class="form-control" value="{{$feedbackTitle->getTranslation('title','pt',false)}}">
                        </div>
                        </div>
                        <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Subtitle</label>
                        <div class="col-sm-12 col-md-7">
                            <small class="text-muted">English <span class="text-danger">*</span></small>
                            <textarea name="sub_title[en]" class="form-control mb-2" style="height: 80px">{{$feedbackTitle->getTranslation('sub_title','en',false)}}</textarea>
                            <small class="text-muted">Español</small>
                            <textarea name="sub_title[es]" class="form-control mb-2" style="height: 80px">{{$feedbackTitle->getTranslation('sub_title','es',false)}}</textarea>
                            <small class="text-muted">Português</small>
                            <textarea name="sub_title[pt]" class="form-control" style="height: 80px">{{$feedbackTitle->getTranslation('sub_title','pt',false)}}</textarea>
                        </div>
                        </div>

                        </div>
                        <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">"Add Yours" Button</label>
                        <div class="col-sm-12 col-md-7">
                            <small class="text-muted">English</small>
                            <input type="text" name="cta_label[en]" class="form-control mb-2" placeholder="Add Yours" value="{{$feedbackTitle->getTranslation('cta_label','en',false)}}">
                            <small class="text-muted">Español</small>
                            <input type="text" name="cta_label[es]" class="form-control mb-2" placeholder="Agrega el Tuyo" value="{{$feedbackTitle->getTranslation('cta_label','es',false)}}">
                            <small class="text-muted">Português</small>
                            <input type="text" name="cta_label[pt]" class="form-control" placeholder="Adicione o Seu" value="{{$feedbackTitle->getTranslation('cta_label','pt',false)}}">
                            <small class="text-muted">Text for the button that invites visitors to submit their own testimonial. Leave blank to use the default shown above.</small>
                        </div>
                        </div>
                        <hr>
                        <p class="text-muted px-3">Below controls the text on the public <code>/testimonial</code> page (where visitors submit their own testimonial).</p>

                        <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">"Submit a Testimonial" Page Title</label>
                        <div class="col-sm-12 col-md-7">
                            <small class="text-muted">English</small>
                            <input type="text" name="page_title[en]" class="form-control mb-2" placeholder="Share Your Experience" value="{{$feedbackTitle->getTranslation('page_title','en',false)}}">
                            <small class="text-muted">Español</small>
                            <input type="text" name="page_title[es]" class="form-control mb-2" placeholder="Comparte Tu Experiencia" value="{{$feedbackTitle->getTranslation('page_title','es',false)}}">
                            <small class="text-muted">Português</small>
                            <input type="text" name="page_title[pt]" class="form-control" placeholder="Compartilhe Sua Experiência" value="{{$feedbackTitle->getTranslation('page_title','pt',false)}}">
                            <small class="text-muted">Leave blank to use the default shown above.</small>
                        </div>
                        </div>

                        <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">"Submit a Testimonial" Page Subtitle</label>
                        <div class="col-sm-12 col-md-7">
                            <small class="text-muted">English</small>
                            <textarea name="page_subtitle[en]" class="form-control mb-2" style="height: 80px" placeholder="Worked with me? Leave a testimonial below — it will appear on the site after a quick review.">{{$feedbackTitle->getTranslation('page_subtitle','en',false)}}</textarea>
                            <small class="text-muted">Español</small>
                            <textarea name="page_subtitle[es]" class="form-control mb-2" style="height: 80px" placeholder="¿Trabajaste conmigo? Deja un testimonio abajo — aparecerá en el sitio tras una breve revisión.">{{$feedbackTitle->getTranslation('page_subtitle','es',false)}}</textarea>
                            <small class="text-muted">Português</small>
                            <textarea name="page_subtitle[pt]" class="form-control" style="height: 80px" placeholder="Já trabalhou comigo? Deixe um depoimento abaixo — ele aparecerá no site após uma breve análise.">{{$feedbackTitle->getTranslation('page_subtitle','pt',false)}}</textarea>
                            <small class="text-muted">Leave blank to use the default shown above.</small>
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