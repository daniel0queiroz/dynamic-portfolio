<section class="service-area section-padding-top" id="about-page">
    <div class="container">
        <div class="row">
            @foreach ($services as $service)
                <div class="col-lg-4 {{$loop->index > 2 ? 'mt-4' : ''}}">
                @if ($service->link)
                    <a href="{{ $service->link }}" target="_blank" rel="noopener noreferrer" class="single-service single-service--link">
                @else
                    <div class="single-service">
                @endif
                    <h3 class="title wow fadeInRight" data-wow-delay="0.3s">{{$service->name}}</h3>
                    <div class="desc wow fadeInRight" data-wow-delay="0.4s">
                        <p>{{$service->description}}</p>
                    </div>
                @if ($service->link)
                    </a>
                @else
                    </div>
                @endif
            </div>
            @endforeach
            
        </div>
    </div>
</section>