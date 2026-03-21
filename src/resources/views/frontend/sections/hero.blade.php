
@php
    $titles = collect($typerTitles)
        ->map(fn($title) => $title->getTranslation('title', app()->getLocale(), false))
        ->filter(fn($title) => is_string($title) && trim($title) !== '')
        ->values()
        ->all();
@endphp

@push('head')
    @if ($hero?->image)
        <link rel="preload" as="image" href="{{ asset($hero->image) }}">
    @endif
@endpush

<header class="header-area parallax-bg"  id="home-page" style="background: url('{{asset($hero?->image)}}') no-repeat scroll top center/cover;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="header-text">
                    <h3 class="typer-title wow fadeInUp" data-wow-delay="0.2s" data-typer-titles='@json($titles)'>{{ $titles[0] ?? '' }}</h3>
                    <h1 class="title wow fadeInUp" data-wow-delay="0.3s">{{$hero?->title}}</h1>
                    <div class="desc wow fadeInUp" data-wow-delay="0.4s">
                        <p>{{$hero?->sub_title}}.</p>
                    </div>
                    @if ($hero?->btn_text)
                         <a href="{{$hero?->btn_url}}" class="button-dark mouse-dir wow fadeInUp" data-wow-delay="0.5s">{{$hero->btn_text}}<span
                            class="dir-part"></span></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>

@push('scripts')
    <script>
        (function initTyperWithRetry() {
            var el = document.querySelector('.header-area .typer-title');
            if (!el) return;
            var titles = [];
            try {
                titles = JSON.parse(el.getAttribute('data-typer-titles') || '[]');
            } catch (e) {}
            if (!titles.length) return;

            var attempts = 0;
            function tryInit() {
                attempts += 1;
                if (window.jQuery && jQuery.fn && jQuery.fn.typer) {
                    jQuery(el).typer(titles);
                    return;
                }
                if (attempts < 30) {
                    setTimeout(tryInit, 100);
                }
            }

            if (document.readyState === 'complete') {
                tryInit();
            } else {
                window.addEventListener('load', tryInit, { once: true });
            }
        })();
    </script>
@endpush
