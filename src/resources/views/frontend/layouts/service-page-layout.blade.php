@php
    $generalSetting = cache()->remember('general_setting', 3600, fn() => \App\Models\GeneralSetting::first());
@endphp
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="referrer" content="no-referrer-when-downgrade">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    @yield('meta')

    <link rel="shortcut icon" type="image/ico" href="{{ asset($generalSetting?->favicon) }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800&display=swap">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">

    @yield('page-styles')

    <style>
        *, *::before, *::after { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            background: #080614;
            color: #fff;
            overflow-x: hidden;
        }

        /* ── Language switcher ── */
        .links-lang {
            position: fixed;
            top: 16px;
            right: 16px;
            z-index: 200;
        }

        .links-lang .dropdown-toggle {
            background: rgba(255,255,255,0.09);
            border: 1px solid rgba(255,255,255,0.16);
            color: #fff;
            border-radius: 20px;
            padding: 5px 14px;
            font-size: 11px;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            letter-spacing: 1.5px;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .links-lang .dropdown-toggle:hover,
        .links-lang .dropdown-toggle:focus {
            background: rgba(255,255,255,0.15);
            outline: none;
            box-shadow: none;
        }

        .links-lang .dropdown-menu {
            background: #13112a;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            min-width: 130px;
            box-shadow: 0 12px 32px rgba(0,0,0,0.5);
        }

        .links-lang .dropdown-item {
            color: rgba(255,255,255,0.75);
            font-size: 13px;
            font-family: 'Poppins', sans-serif;
            padding: 9px 16px;
            border-radius: 8px;
            margin: 2px 4px;
            width: calc(100% - 8px);
        }

        .links-lang .dropdown-item:hover,
        .links-lang .dropdown-item.active {
            background: rgba(85,107,255,0.22);
            color: #fff;
        }

        /* ════════════════════════════════════════
           HERO — with background image
           Uses CSS custom properties injected
           inline so media queries can swap them.
        ════════════════════════════════════════ */
        .sp-hero-banner {
            position: relative;
            display: flex;
            align-items: flex-end;
            min-height: 380px;
            background-image: var(--hero-bg-mobile);
            background-size: cover;
            background-position: center;
        }

        @media (min-width: 768px) {
            .sp-hero-banner {
                min-height: 540px;
                background-image: var(--hero-bg-desktop);
            }
        }

        .sp-hero-banner-overlay {
            position: absolute;
            inset: 0;
            /* Stronger gradient on mobile for readability over portrait images */
            background: linear-gradient(
                to bottom,
                rgba(8,6,20,0.25) 0%,
                rgba(8,6,20,0.55) 45%,
                rgba(8,6,20,0.96) 100%
            );
        }

        @media (min-width: 768px) {
            .sp-hero-banner-overlay {
                background: linear-gradient(
                    to bottom,
                    rgba(8,6,20,0.1) 0%,
                    rgba(8,6,20,0.5) 45%,
                    rgba(8,6,20,0.96) 100%
                );
            }
        }

        .sp-hero-banner-content {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 860px;
            margin: 0 auto;
            padding: 28px 20px 36px;
        }

        @media (min-width: 768px) {
            .sp-hero-banner-content {
                padding: 60px 32px 52px;
            }
        }

        /* ════════════════════════════════════════
           HERO — no image (text only)
        ════════════════════════════════════════ */
        .sp-hero-text {
            position: relative;
            text-align: center;
            padding: 100px 20px 52px;
        }

        .sp-hero-text::before {
            content: '';
            position: absolute;
            top: 0; left: 50%;
            transform: translateX(-50%);
            width: 600px;
            height: 400px;
            background: radial-gradient(ellipse at 50% 30%, rgba(85,107,255,0.16) 0%, transparent 70%);
            pointer-events: none;
        }

        @media (min-width: 768px) {
            .sp-hero-text { padding: 120px 32px 72px; }
        }

        /* ════════════════════════════════════════
           TYPOGRAPHY
        ════════════════════════════════════════ */
        .sp-title {
            font-size: clamp(26px, 7vw, 56px);
            font-weight: 800;
            line-height: 1.1;
            margin: 0 0 14px;
            letter-spacing: -0.5px;
            text-shadow: 0 2px 20px rgba(0,0,0,0.4);
        }

        @media (min-width: 768px) {
            .sp-title { margin-bottom: 20px; letter-spacing: -1px; }
        }

        .sp-subtitle {
            font-size: 15px;
            color: rgba(255,255,255,0.75);
            line-height: 1.75;
            margin: 0;
        }

        @media (min-width: 768px) {
            .sp-subtitle {
                font-size: clamp(15px, 1.8vw, 18px);
                max-width: 640px;
            }
            .sp-hero-text .sp-subtitle { margin: 0 auto; }
        }

        /* ════════════════════════════════════════
           CONTENT WRAPPER
        ════════════════════════════════════════ */
        .sp-content {
            max-width: 860px;
            margin: 0 auto;
            padding: 32px 20px 60px;
        }

        @media (min-width: 768px) {
            .sp-content { padding: 0 32px 80px; }
        }

        /* ════════════════════════════════════════
           DIVIDER
        ════════════════════════════════════════ */
        .sp-divider {
            border: none;
            border-top: 1px solid rgba(255,255,255,0.07);
            margin: 40px 0;
        }

        @media (min-width: 768px) { .sp-divider { margin: 56px 0; } }

        /* ════════════════════════════════════════
           VIDEO
        ════════════════════════════════════════ */
        .sp-video-wrapper {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            border-radius: 14px;
            overflow: hidden;
            background: #0d0b1e;
            box-shadow: 0 20px 60px rgba(0,0,0,0.55), 0 0 0 1px rgba(255,255,255,0.07);
        }

        @media (min-width: 768px) {
            .sp-video-wrapper {
                border-radius: 20px;
                box-shadow: 0 32px 80px rgba(0,0,0,0.6), 0 0 0 1px rgba(255,255,255,0.07);
            }
        }

        .sp-video-wrapper iframe {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        .sp-video-link {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 13px 24px;
            background: linear-gradient(135deg, rgba(85,107,255,0.18), rgba(130,90,255,0.18));
            border: 1px solid rgba(110,100,255,0.35);
            border-radius: 12px;
            color: #a5b4fc;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: background 0.2s, border-color 0.2s, transform 0.2s;
        }

        .sp-video-link:hover {
            background: linear-gradient(135deg, rgba(85,107,255,0.28), rgba(130,90,255,0.28));
            border-color: rgba(110,100,255,0.6);
            color: #c4b5fd;
            text-decoration: none;
            transform: translateY(-2px);
        }

        /* ════════════════════════════════════════
           FAQ
        ════════════════════════════════════════ */
        .sp-faq-heading {
            font-size: 20px;
            font-weight: 700;
            margin: 0 0 20px;
            letter-spacing: -0.2px;
        }

        @media (min-width: 768px) {
            .sp-faq-heading { font-size: 22px; margin-bottom: 28px; }
        }

        .sp-faq-section .accordion-item {
            background: transparent;
            border: 1px solid rgba(255,255,255,0.09);
            border-radius: 12px !important;
            margin-bottom: 8px;
            overflow: hidden;
            transition: border-color 0.2s;
        }

        .sp-faq-section .accordion-item:hover {
            border-color: rgba(255,255,255,0.16);
        }

        .sp-faq-section .accordion-button {
            background: rgba(255,255,255,0.03);
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 600;
            padding: 17px 18px;
            border-radius: 12px !important;
            line-height: 1.4;
        }

        @media (min-width: 768px) {
            .sp-faq-section .accordion-button { font-size: 15px; padding: 20px 24px; }
        }

        .sp-faq-section .accordion-button:not(.collapsed) {
            background: rgba(85,107,255,0.1);
            color: #a5b4fc;
            box-shadow: none;
            border-radius: 12px 12px 0 0 !important;
        }

        .sp-faq-section .accordion-button::after {
            filter: invert(1) brightness(1.5);
            opacity: 0.55;
            flex-shrink: 0;
        }

        .sp-faq-section .accordion-button:not(.collapsed)::after { opacity: 1; }
        .sp-faq-section .accordion-button:focus { box-shadow: none; }

        .sp-faq-section .accordion-body {
            background: rgba(85,107,255,0.05);
            color: rgba(255,255,255,0.68);
            font-size: 14px;
            line-height: 1.8;
            padding: 14px 18px 18px;
        }

        @media (min-width: 768px) {
            .sp-faq-section .accordion-body { padding: 18px 24px 22px; }
        }

        /* ════════════════════════════════════════
           FOOTER
        ════════════════════════════════════════ */
        .sp-footer {
            text-align: center;
            padding-top: 8px;
        }

        .sp-footer a {
            color: rgba(255,255,255,0.28);
            font-size: 12px;
            text-decoration: none;
            transition: color 0.15s;
        }

        .sp-footer a:hover { color: rgba(255,255,255,0.55); }

        /* ════════════════════════════════════════
           ENTRANCE ANIMATION
        ════════════════════════════════════════ */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .sp-animate { animation: fadeUp 0.55s ease both; }
        .sp-animate-delay-1 { animation-delay: 0.1s; }
        .sp-animate-delay-2 { animation-delay: 0.22s; }
        .sp-animate-delay-3 { animation-delay: 0.34s; }
    </style>
</head>
<body>
    @yield('content')

    <script src="{{ asset('frontend/assets/js/vendor/jquery-min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/lang-switch.js') }}"></script>
</body>
</html>
