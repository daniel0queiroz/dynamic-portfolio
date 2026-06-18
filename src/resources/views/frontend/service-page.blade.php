@extends('frontend.layouts.service-page-layout')

@php
    $locale = app()->getLocale();

    $hasImage   = $page->image || $page->mobile_image;
    $desktopBg  = $page->image        ? asset($page->image)        : null;
    $mobileBg   = $page->mobile_image ? asset($page->mobile_image) : $desktopBg;

    $embedUrl = null;
    if ($page->video_url) {
        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_\-]{11})/', $page->video_url, $m)) {
            $embedUrl = 'https://www.youtube.com/embed/' . $m[1] . '?rel=0&modestbranding=1';
        } elseif (preg_match('/vimeo\.com\/(\d+)/', $page->video_url, $m)) {
            $embedUrl = 'https://player.vimeo.com/video/' . $m[1] . '?dnt=1';
        }
    }
@endphp

@section('meta')
    <title>{{ $page->getTranslation('title', $locale, true) }}</title>
    <meta name="description" content="{{ Str::limit($page->getTranslation('subtitle', $locale, true), 160) }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $page->getTranslation('title', $locale, true) }}">
    <meta property="og:description" content="{{ Str::limit($page->getTranslation('subtitle', $locale, true), 160) }}">
    <meta property="og:url" content="{{ url('service/' . $page->slug) }}">
    @if ($desktopBg)
        <meta property="og:image" content="{{ $desktopBg }}">
    @endif
@endsection

@if ($hasImage)
@section('page-styles')
<style>
    .sp-hero-banner {
        --hero-bg-desktop: url('{{ $desktopBg ?? $mobileBg }}');
        --hero-bg-mobile:  url('{{ $mobileBg ?? $desktopBg }}');
    }
</style>
@endsection
@endif

@section('content')

    {{-- Language switcher — fixed top right --}}
    <div class="links-lang">
        <div class="dropdown">
            <button class="btn dropdown-toggle" id="langDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                {{ strtoupper($locale) }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="langDropdown">
                <li>
                    <a class="dropdown-item {{ $locale == 'en' ? 'active' : '' }}"
                       href="{{ route('lang.switch', 'en') }}">English</a>
                </li>
                <li>
                    <a class="dropdown-item {{ $locale == 'es' ? 'active' : '' }}"
                       href="{{ route('lang.switch', 'es') }}">Español</a>
                </li>
                <li>
                    <a class="dropdown-item {{ $locale == 'pt' ? 'active' : '' }}"
                       href="{{ route('lang.switch', 'pt') }}">Português</a>
                </li>
            </ul>
        </div>
    </div>

    {{-- Hero --}}
    @if ($hasImage)
        <div class="sp-hero-banner">
            <div class="sp-hero-banner-overlay"></div>
            <div class="sp-hero-banner-content">
                <h1 class="sp-title sp-animate">
                    {{ $page->getTranslation('title', $locale, true) }}
                </h1>
                <p class="sp-subtitle sp-animate sp-animate-delay-1">
                    {{ $page->getTranslation('subtitle', $locale, true) }}
                </p>
            </div>
        </div>
    @else
        <div class="sp-hero-text sp-animate">
            <h1 class="sp-title">{{ $page->getTranslation('title', $locale, true) }}</h1>
            <p class="sp-subtitle">{{ $page->getTranslation('subtitle', $locale, true) }}</p>
        </div>
    @endif

    <div class="sp-content">

        {{-- Video --}}
        @if ($page->video_url)
            <div class="sp-animate sp-animate-delay-2">
                @if ($embedUrl)
                    <div class="sp-video-wrapper">
                        <iframe src="{{ $embedUrl }}"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen
                                loading="lazy"
                                title="{{ $page->getTranslation('title', $locale, true) }}">
                        </iframe>
                    </div>
                @else
                    <a href="{{ $page->video_url }}" target="_blank" rel="noopener noreferrer" class="sp-video-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM6.5 5.5v5l5-2.5-5-2.5z"/>
                        </svg>
                        Watch Video
                    </a>
                @endif
            </div>
        @endif

        {{-- FAQ accordion --}}
        @if ($page->faqs->isNotEmpty())
            <hr class="sp-divider">

            <div class="sp-faq-section sp-animate sp-animate-delay-3">
                <h2 class="sp-faq-heading">Frequently Asked Questions</h2>

                <div class="accordion" id="faqAccordion">
                    @foreach ($page->faqs as $faq)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHead{{ $faq->id }}">
                                <button class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#faqBody{{ $faq->id }}"
                                        aria-expanded="false"
                                        aria-controls="faqBody{{ $faq->id }}">
                                    {{ $faq->getTranslation('question', $locale, true) }}
                                </button>
                            </h2>
                            <div id="faqBody{{ $faq->id }}"
                                 class="accordion-collapse collapse"
                                 aria-labelledby="faqHead{{ $faq->id }}"
                                 data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    {!! nl2br(e($faq->getTranslation('answer', $locale, true))) !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <hr class="sp-divider">

        <div class="sp-footer">
            <a href="{{ url('/') }}">danqueiroz.com</a>
            &nbsp;&middot;&nbsp;
            <a href="{{ route('privacy-policy') }}">Privacy Policy</a>
        </div>

    </div>

@endsection
