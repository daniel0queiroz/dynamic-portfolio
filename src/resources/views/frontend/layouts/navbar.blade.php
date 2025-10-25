@php
    $routeName = Route::currentRouteName();
@endphp

<nav class="navbar navbar-expand-lg main_menu" id="main_menu_area">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset($generalSetting->logo) }}" alt="">
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
                        Home
                    </a>
                </li>

                @if ($routeName == 'home')
                    <li class="nav-item">
                        <a class="nav-link" href="#about-page">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#portfolio-page">Portfolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#skills-page">Skills</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact-page">Contact</a>
                    </li>
                @endif

                @if ($routeName == 'portfolio' || $routeName == 'show.portfolio')
                    <li class="nav-item">
                        <a class="nav-link {{ $routeName == 'portfolio' || $routeName == 'show.portfolio' ? 'active' : '' }}"
                            href="{{ route('portfolio') }}">
                            Portfolio
                        </a>
                    </li>
                @endif

                @if ($routeName == 'blog' || $routeName == 'show.blog')
                    <li class="nav-item">
                        <a class="nav-link {{ $routeName == 'blog' || $routeName == 'show.blog' ? 'active' : '' }}"
                            href="{{ route('blog') }}">
                            Blogs
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
