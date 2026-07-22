@php
    $whatsappSetting = cache()->remember('whatsapp_setting', 3600, fn() => \App\Models\WhatsappSetting::first());

    // A landing page's own WhatsApp settings (if enabled) take priority over the
    // site-wide default, so each service can have its own number/message.
    if (isset($page) && $page->whatsapp_enabled && $page->whatsapp_number) {
        $whatsappPhoneNumber = $page->whatsapp_number;
        $whatsappMessage = $page->getWhatsappMessageForLocale(app()->getLocale());
    } elseif ($whatsappSetting?->is_enabled && $whatsappSetting->phone_number) {
        $whatsappPhoneNumber = $whatsappSetting->phone_number;
        $whatsappMessage = $whatsappSetting->getMessageForLocale(app()->getLocale());
    } else {
        $whatsappPhoneNumber = null;
    }
@endphp

@if ($whatsappPhoneNumber)
    @php
        $whatsappNumber = preg_replace('/\D/', '', $whatsappPhoneNumber);
        $whatsappUrl = 'https://wa.me/' . $whatsappNumber . ($whatsappMessage ? '?text=' . urlencode($whatsappMessage) : '');
        $whatsappLabels = ['en' => 'Chat on WhatsApp', 'es' => 'Chatea por WhatsApp', 'pt' => 'Fale no WhatsApp'];
        $whatsappLabel = $whatsappLabels[app()->getLocale()] ?? $whatsappLabels['en'];
    @endphp

    <div class="wa-float-wrap">
        <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener" class="wa-float-btn" aria-label="{{ $whatsappLabel }}">
            <span class="wa-float-ring" aria-hidden="true"></span>
            <svg viewBox="0 0 448 512" width="27" height="31" fill="currentColor" aria-hidden="true">
                <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
            </svg>
        </a>
        <span class="wa-float-label">{{ $whatsappLabel }}</span>
    </div>

    <style>
        .wa-float-wrap {
            position: fixed;
            right: 22px;
            bottom: max(22px, env(safe-area-inset-bottom));
            z-index: 1000;
            display: flex;
            flex-direction: row-reverse;
            align-items: center;
            gap: 12px;
        }

        .wa-float-label {
            padding: 9px 16px;
            background: rgba(12, 16, 20, 0.85);
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.1px;
            white-space: nowrap;
            border-radius: 999px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.28);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            opacity: 0;
            transform: translateX(8px);
            pointer-events: none;
            transition: opacity 0.2s ease, transform 0.2s ease;
        }

        .wa-float-wrap:hover .wa-float-label,
        .wa-float-btn:focus-visible + .wa-float-label {
            opacity: 1;
            transform: translateX(0);
        }

        .wa-float-btn {
            position: relative;
            width: 58px;
            height: 58px;
            flex-shrink: 0;
            border-radius: 50%;
            background: linear-gradient(145deg, #2fd66c 0%, #25d366 45%, #128c7e 100%);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow:
                0 10px 26px rgba(18, 140, 126, 0.4),
                0 3px 10px rgba(0, 0, 0, 0.3),
                inset 0 1px 1px rgba(255, 255, 255, 0.35);
            transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.25s ease;
        }

        .wa-float-btn svg {
            position: relative;
            z-index: 1;
            filter: drop-shadow(0 1px 1px rgba(0, 0, 0, 0.15));
        }

        .wa-float-ring {
            position: absolute;
            inset: 0;
            border-radius: 50%;
            background: rgba(37, 211, 102, 0.55);
            animation: wa-pulse 2.6s ease-out infinite;
        }

        @keyframes wa-pulse {
            0% { transform: scale(1); opacity: 0.55; }
            70% { transform: scale(1.9); opacity: 0; }
            100% { transform: scale(1.9); opacity: 0; }
        }

        .wa-float-btn:hover,
        .wa-float-btn:focus-visible {
            transform: translateY(-4px) scale(1.06);
            box-shadow:
                0 16px 34px rgba(18, 140, 126, 0.48),
                0 6px 14px rgba(0, 0, 0, 0.32),
                inset 0 1px 1px rgba(255, 255, 255, 0.35);
            outline: none;
        }

        @media (max-width: 640px) {
            .wa-float-label { display: none; }
            .wa-float-wrap { right: 16px; bottom: max(16px, env(safe-area-inset-bottom)); }
            .wa-float-btn { width: 54px; height: 54px; }
        }

        @media (prefers-reduced-motion: reduce) {
            .wa-float-ring { animation: none; display: none; }
            .wa-float-btn { transition: none; }
        }
    </style>
@endif
