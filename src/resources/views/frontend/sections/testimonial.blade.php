<section class="testimonial-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 text-center">
                <div class="section-title">
                    <h3 class="title">{{$feedbackTitle?->title}}</h3>
                    <div class="desc">
                        <p>{{$feedbackTitle?->sub_title}}</p>
                    </div>
                    <a href="{{ route('testimonial.create') }}" class="button-primary-trans mouse-dir mt-3">
                        {{ $feedbackTitle?->cta_label ?: __('ui.testimonial.add_yours') }} <span class="dir-part"></span>
                        <i class="fal fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="testimonial-slider">
                    @foreach ($feedbacks as $feedback)
                        <div class="single-testimonial">
                        <div class="testimonial-header">
                            <div class="quote">
                                <i class="fas fa-quote-left"></i>
                            </div>
                            <h5 class="title">{{$feedback->name}}</h5>
                            @if($feedback->role || $feedback->company)
                                <h6 class="position">{{ implode(' - ', array_filter([$feedback->role, $feedback->company])) }}</h6>
                            @endif
                        </div>
                        <div class="content">
                            {!! $feedback->description !!}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>