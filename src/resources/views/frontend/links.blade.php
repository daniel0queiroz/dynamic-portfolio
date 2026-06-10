@extends('frontend.layouts.links-layout')

@section('meta')
    <title>Links | Dan Queiroz</title>
    <meta name="description" content="All links from Dan Queiroz — developer, designer and creator.">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Links | Dan Queiroz">
    <meta property="og:description" content="All links from Dan Queiroz — developer, designer and creator.">
    <meta property="og:url" content="{{ url('/links') }}">
    @if ($about?->image)
        <meta property="og:image" content="{{ asset($about->image) }}">
    @endif
@endsection

@section('content')
    {{-- Profile header --}}
    <div class="links-profile">
        @if ($about?->image)
            <img class="links-avatar" src="{{ asset($about->image) }}" alt="Dan Queiroz">
        @endif
        <h1 class="links-profile-name">Dan Queiroz</h1>
        <p class="links-profile-bio">Developer &amp; Designer</p>
    </div>

    {{-- Language switcher --}}
    <div class="links-lang">
        <div class="dropdown">
            <button class="btn dropdown-toggle" id="langDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                {{ strtoupper(app()->getLocale()) }}
            </button>
            <ul class="dropdown-menu" aria-labelledby="langDropdown">
                <li>
                    <a class="dropdown-item {{ app()->getLocale() == 'en' ? 'active' : '' }}"
                       href="{{ route('lang.switch', 'en') }}">English</a>
                </li>
                <li>
                    <a class="dropdown-item {{ app()->getLocale() == 'es' ? 'active' : '' }}"
                       href="{{ route('lang.switch', 'es') }}">Español</a>
                </li>
                <li>
                    <a class="dropdown-item {{ app()->getLocale() == 'pt' ? 'active' : '' }}"
                       href="{{ route('lang.switch', 'pt') }}">Português</a>
                </li>
            </ul>
        </div>
    </div>

    {{-- Link cards --}}
    @forelse ($linkItems as $item)
        <a href="{{ $item->url }}"
           target="_blank"
           rel="noopener noreferrer"
           class="link-card"
           style="background-image: url('{{ asset($item->thumbnail) }}')">
            <div class="link-card-overlay">
                <span class="link-card-name">
                    {{ $item->getTranslation('name', app()->getLocale(), true) }}
                </span>
                <span class="link-card-arrow">&#8594;</span>
            </div>
        </a>
    @empty
        <div class="links-empty">No links available yet.</div>
    @endforelse

    {{-- Footer --}}
    <div class="links-footer">
        <a href="{{ url('/') }}">danqueiroz.com</a>
        &nbsp;&middot;&nbsp;
        <a href="{{ route('privacy-policy') }}">Privacy Policy</a>
    </div>
@endsection
