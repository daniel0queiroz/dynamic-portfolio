@php
    $routeName = Route::currentRouteName();
@endphp

<nav class="navbar navbar-expand-lg main_menu" id="main_menu_area">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset($generalSetting?->logo) }}" alt="" decoding="async" fetchpriority="high">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="far fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link {{ $routeName == 'home' ? 'active' : '' }}"
                        href="{{ $routeName == 'home' ? '#home-page' : url('/') }}">
                        {{ __('ui.nav.home') }}
                    </a>
                </li>

                @if ($routeName == 'home')
                    <li class="nav-item">
                        <a class="nav-link" href="#about-page">{{ __('ui.nav.about') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#portfolio-page">{{ __('ui.nav.portfolio') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#skills-page">{{ __('ui.nav.skills') }}</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" href="#blog-page">{{ __('ui.nav.blogs') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact-page">{{ __('ui.nav.contact') }}</a>
                    </li>
                @endif

                @if ($routeName == 'portfolio' || $routeName == 'show.portfolio')
                    <li class="nav-item">
                        <a class="nav-link {{ $routeName == 'portfolio' || $routeName == 'show.portfolio' ? 'active' : '' }}"
                            href="{{ route('portfolio') }}">
                            {{ __('ui.nav.portfolio') }}
                        </a>
                    </li>
                @endif

                @if ($routeName == 'blog' || $routeName == 'show.blog')
                    <li class="nav-item">
                        <a class="nav-link {{ $routeName == 'blog' || $routeName == 'show.blog' ? 'active' : '' }}"
                            href="{{ route('blog') }}">
                            {{ __('ui.nav.blogs') }}
                        </a>
                    </li>
                @endif

                @if ($routeName == 'privacy-policy')
                    <li class="nav-item">
                        <a class="nav-link {{ $routeName == 'privacy-policy' ? 'active' : '' }}" href="{{ route('privacy-policy') }}">
                            {{ __('ui.nav.privacy') }}
                        </a>
                    </li>
                @endif
            </ul>

            <ul class="navbar-nav ms-2">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="langDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ strtoupper(app()->getLocale()) }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="langDropdown" style="background-color: #fff;">
                        <li><a class="dropdown-item {{ app()->getLocale() == 'en' ? 'active' : '' }}" href="{{ route('lang.switch', 'en') }}" style="color: #190844;">English</a></li>
                        <li><a class="dropdown-item {{ app()->getLocale() == 'es' ? 'active' : '' }}" href="{{ route('lang.switch', 'es') }}" style="color: #190844;">Español</a></li>
                        <li><a class="dropdown-item {{ app()->getLocale() == 'pt' ? 'active' : '' }}" href="{{ route('lang.switch', 'pt') }}" style="color: #190844;">Português</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
