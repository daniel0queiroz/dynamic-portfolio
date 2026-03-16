@extends('frontend.layouts.layout')

@section('content')
        <header class="site-header parallax-bg">
            <div class="container">
                <div class="row d-flex align-items-center">
                    <div class="col-sm-7">
                        <h2 class="title">{{ __('ui.titles.portfolio') }}</h2>
                    </div>
                    <div class="col-sm-5">
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
        <section class="card-area section-padding">
            <div class="container">
                <div class="row">
                    @foreach ($portfolios as $portfolio)
                        <div class="col-xl-4 col-md-6">
                            <div class="single-card">
                                <figure class="card-image">
                                    <img src="{{asset($portfolio->image)}}" alt="">
                                </figure>
                                <div class="card-content">
                                    <h3 class="title"><a href="{{route('show.portfolio', $portfolio->id)}}">{{$portfolio->title}}</a></h3>
                                    <div class="desc">
                                        <p>{!! Str::limit(strip_tags($portfolio->description), 150, '...') !!}</p>
                                    </div>
                                    <a href="{{route('show.portfolio', $portfolio->id)}}" class="button-primary-trans mouse-dir">{{ __('ui.buttons.view_project') }} <span
                                            class="dir-part"></span> <i class="fal fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <nav class="navigation pagination">
                            <div class="nav-links d-flex justify-content-center">
                                {{$portfolios->links()}}
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <!-- Portfolio-Area-End -->
@endsection
