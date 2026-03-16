@extends('frontend.layouts.layout')

@section('content')
        <header class="site-header parallax-bg">
            <div class="container">
                <div class="row d-flex align-items-center">
                    <div class="col-sm-8">
                        <h2 class="title">{{ __('ui.titles.portfolio_details') }}</h2>
                    </div>
                    <div class="col-sm-4">
                        <div class="breadcrumbs">
                            <ul>
                                <li><a href="#">{{ __('ui.breadcrumbs.home') }}</a></li>
                                <li>{{ __('ui.breadcrumbs.portfolio') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Portfolio-Area-Start -->
        <section class="portfolio-details section-padding" id="portfolio-page">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h2 class="head-title">{{$portfolio->title}}</h2>
                        <figure class="image-block">
                            <img src="{{asset($portfolio->image)}}" alt="" class="img-fix">
                        </figure>
                        <div class="portflio-info d-flex flex-wrap justify-content-evenly text-center">
                            @if(!empty($portfolio->client))
                                <div class="single-info">
                                    <h4 class="title">{{ __('ui.labels.client') }}</h4>
                                    <p>{{ $portfolio->client }}</p>
                                </div>
                            @endif
                            <div class="single-info">
                                <h4 class="title">{{ __('ui.labels.date') }}</h4>
                                <p>{{date('d M, Y', strtotime($portfolio->created_at))}}</p>
                            </div>
                            @if(!empty($portfolio->website))
                                <div class="single-info">
                                    <h4 class="title">{{ __('ui.labels.website') }}</h4>
                                    <p><a href="{{ $portfolio->website }}" target="_blank">{{ $portfolio->website }}</a></p>
                                </div>
                            @endif
                            <div class="single-info">
                                <h4 class="title">{{ __('ui.labels.category') }}</h4>
                                <p>{{$portfolio->category->name}}</p>
                            </div>
                        </div>
                        <div class="description">
                            {!! $portfolio->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Portfolio-Area-End -->
@endsection
