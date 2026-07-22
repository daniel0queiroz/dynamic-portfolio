@php
    $whatsappSetting = cache()->remember('whatsapp_setting', 3600, fn() => \App\Models\WhatsappSetting::first());
@endphp

@if ($whatsappSetting?->is_enabled && $whatsappSetting->phone_number)
    @php
        $whatsappNumber = preg_replace('/\D/', '', $whatsappSetting->phone_number);
        $whatsappMessage = $whatsappSetting->getMessageForLocale(app()->getLocale());
        $whatsappUrl = 'https://wa.me/' . $whatsappNumber . ($whatsappMessage ? '?text=' . urlencode($whatsappMessage) : '');
    @endphp

    <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener" class="wa-float-btn" aria-label="Chat on WhatsApp">
        <svg viewBox="0 0 32 32" width="30" height="30" fill="currentColor" aria-hidden="true">
            <path d="M16.004 3C9.377 3 4 8.373 4 15c0 2.31.66 4.47 1.804 6.31L4 29l7.865-1.766A11.94 11.94 0 0 0 16.004 27C22.63 27 28 21.627 28 15S22.63 3 16.004 3Zm0 21.818a9.77 9.77 0 0 1-4.98-1.363l-.357-.212-4.667 1.048 1.06-4.554-.233-.372A9.77 9.77 0 0 1 5.2 15c0-5.964 4.84-10.818 10.804-10.818S26.8 9.036 26.8 15 21.968 24.818 16.004 24.818Zm5.396-7.845c-.296-.148-1.75-.864-2.022-.963-.271-.099-.469-.148-.667.148-.197.296-.765.963-.938 1.16-.173.198-.345.223-.64.075-.297-.148-1.253-.462-2.386-1.472-.882-.787-1.478-1.76-1.65-2.057-.173-.297-.019-.457.13-.605.133-.132.296-.346.444-.519.148-.173.197-.296.296-.494.099-.198.05-.37-.025-.519-.074-.148-.667-1.61-.914-2.204-.24-.578-.485-.5-.667-.51l-.568-.01c-.198 0-.519.075-.79.371-.272.297-1.037 1.014-1.037 2.474 0 1.46 1.062 2.87 1.21 3.068.148.198 2.09 3.19 5.062 4.474.707.305 1.258.487 1.688.623.709.226 1.354.194 1.864.118.569-.085 1.75-.716 1.997-1.407.247-.692.247-1.284.173-1.407-.074-.123-.271-.198-.568-.346Z"/>
        </svg>
    </a>

    <style>
        .wa-float-btn {
            position: fixed;
            right: 20px;
            bottom: 20px;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: #25D366;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            transition: transform 0.18s ease, box-shadow 0.18s ease;
        }

        .wa-float-btn:hover,
        .wa-float-btn:focus {
            color: #fff;
            transform: translateY(-3px);
            box-shadow: 0 10px 26px rgba(0, 0, 0, 0.4);
        }
    </style>
@endif
