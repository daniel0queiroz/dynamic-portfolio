@extends('frontend.layouts.service-page-layout')

@php
    $locale = app()->getLocale();

    $hasImage   = $page->image || $page->mobile_image;
    $desktopBg  = $page->image        ? asset($page->image)        : null;
    $mobileBg   = $page->mobile_image ? asset($page->mobile_image) : $desktopBg;
    $ctaLabel   = $page->getTranslation('cta_label', $locale, true);
    $formTitle  = $page->getTranslation('form_title', $locale, true);
    $hasForm    = $page->lead_form_enabled && $page->leadFormFields->isNotEmpty();
    $hasFaqs    = $page->faq_enabled && $page->faqs->isNotEmpty();

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
                @if ($ctaLabel && $hasForm)
                    <a href="#lead-form" class="sp-cta-btn sp-animate sp-animate-delay-2" onclick="smoothScrollToForm(event)">
                        {{ $ctaLabel }}
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="margin-left:6px">
                            <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                        </svg>
                    </a>
                @endif
            </div>
        </div>
    @else
        <div class="sp-hero-text sp-animate">
            <h1 class="sp-title">{{ $page->getTranslation('title', $locale, true) }}</h1>
            <p class="sp-subtitle">{{ $page->getTranslation('subtitle', $locale, true) }}</p>
            @if ($ctaLabel && $hasForm)
                <a href="#lead-form" class="sp-cta-btn sp-animate sp-animate-delay-2" onclick="smoothScrollToForm(event)">
                    {{ $ctaLabel }}
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="margin-left:6px">
                        <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                    </svg>
                </a>
            @endif
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
        @if ($hasFaqs)
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

        {{-- Lead Form --}}
        @if ($hasForm)
            <hr class="sp-divider">

            <div id="lead-form" class="sp-form-section sp-animate sp-animate-delay-3">

                @if (session('lead_success'))
                    <div class="sp-form-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.061L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </svg>
                        <p>{{ session('lead_success') }}</p>
                    </div>
                @else
                    @if ($formTitle)
                        <h2 class="sp-form-title">{{ $formTitle }}</h2>
                    @endif
                    @php $formSubtitle = $page->getTranslation('form_subtitle', $locale, true); @endphp
                    @if ($formSubtitle)
                        <p class="sp-form-subtitle">{{ $formSubtitle }}</p>
                    @endif

                    <form action="{{ route('lead.store', $page->slug) }}" method="POST" class="sp-form" novalidate>
                        @csrf

                        {{-- Honeypot --}}
                        <input type="text" name="website" style="display:none" tabindex="-1" autocomplete="off">

                        @if ($errors->any())
                            <div class="sp-form-error-box">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                        @foreach ($page->leadFormFields as $field)
                            @php
                                $fieldName    = 'field_' . $field->id;
                                $label        = $field->getTranslation('label', $locale, true);
                                $placeholder  = $field->getTranslation('placeholder', $locale, true);
                                $oldValue     = old($fieldName, '');
                                $hasError     = $errors->has($fieldName);
                            @endphp
                            <div class="sp-form-group{{ $hasError ? ' sp-form-group--error' : '' }}">
                                <label class="sp-form-label">
                                    {{ $label }}
                                    @if ($field->is_required)
                                        <span class="sp-form-required">*</span>
                                    @endif
                                </label>

                                @if ($field->type === 'textarea')
                                    <textarea name="{{ $fieldName }}"
                                              class="sp-form-input"
                                              rows="4"
                                              placeholder="{{ $placeholder }}"
                                              {{ $field->is_required ? 'required' : '' }}>{{ $oldValue }}</textarea>
                                @elseif ($field->type === 'select')
                                    <select name="{{ $fieldName }}"
                                            class="sp-form-input sp-form-select"
                                            {{ $field->is_required ? 'required' : '' }}>
                                        <option value="">{{ $placeholder ?: '— Select —' }}</option>
                                        @foreach ($field->getDecodedOptions() as $option)
                                            <option value="{{ $option['value'] }}"
                                                    {{ $oldValue === $option['value'] ? 'selected' : '' }}>
                                                {{ $option['label'][$locale] ?? $option['label']['en'] ?? $option['value'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                    <input type="{{ $field->type }}"
                                           name="{{ $fieldName }}"
                                           class="sp-form-input"
                                           placeholder="{{ $placeholder }}"
                                           value="{{ $oldValue }}"
                                           {{ $field->is_required ? 'required' : '' }}>
                                @endif

                                @if ($hasError)
                                    <span class="sp-form-field-error">{{ $errors->first($fieldName) }}</span>
                                @endif
                            </div>
                        @endforeach

                        {{-- LGPD Consent --}}
                        <div class="sp-form-group sp-form-group--consent{{ $errors->has('lgpd_consent') ? ' sp-form-group--error' : '' }}">
                            <label class="sp-form-consent-label">
                                <input type="checkbox" name="lgpd_consent" value="1" {{ old('lgpd_consent') ? 'checked' : '' }}>
                                <span>
                                    @if ($locale === 'pt')
                                        Concordo com o tratamento dos meus dados pessoais conforme a
                                        <a href="{{ route('privacy-policy') }}" target="_blank">Política de Privacidade</a>.
                                    @elseif ($locale === 'es')
                                        Acepto el tratamiento de mis datos personales según la
                                        <a href="{{ route('privacy-policy') }}" target="_blank">Política de Privacidad</a>.
                                    @else
                                        I agree to the processing of my personal data as per the
                                        <a href="{{ route('privacy-policy') }}" target="_blank">Privacy Policy</a>.
                                    @endif
                                </span>
                            </label>
                        </div>

                        <button type="submit" class="sp-form-submit">
                            @if ($locale === 'pt') Enviar
                            @elseif ($locale === 'es') Enviar
                            @else Send
                            @endif
                        </button>
                    </form>
                @endif
            </div>
        @endif

        <hr class="sp-divider">

        <div class="sp-footer">
            <a href="{{ url('/') }}">danqueiroz.com</a>
            &nbsp;&middot;&nbsp;
            <a href="{{ route('privacy-policy') }}">Privacy Policy</a>
        </div>

    </div>

<script>
function smoothScrollToForm(e) {
    e.preventDefault();
    const target = document.getElementById('lead-form');
    if (target) {
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
}
</script>

@endsection
