@extends('frontend.layouts.layout')

@section('content')
        <header class="site-header parallax-bg">
            <div class="container">
                <div class="row d-flex align-items-center">
                    <div class="col-sm-8">
                        <h2 class="title">Privacy Policy</h2>
                    </div>
                    <div class="col-sm-4">
                        <div class="breadcrumbs">
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li>Privacy Policy</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Portfolio-Area-Start -->
        <section class="privacy-policy-details section-padding" id="privacy-policy-page">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h2 class="head-title">{{$privacyPolicy->title}}</h2>
                        <div class="description">
                            {!! $privacyPolicy->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Portfolio-Area-End -->
@endsection