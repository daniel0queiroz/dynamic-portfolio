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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,600,700,800&display=swap">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">

    <style>
        *, *::before, *::after { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            background: #0d0b1e;
            color: #fff;
        }

        .links-wrapper {
            max-width: 520px;
            margin: 0 auto;
            padding: 40px 20px 60px;
        }

        /* Profile header */
        .links-profile {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-bottom: 36px;
        }

        .links-avatar {
            width: 88px;
            height: 88px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #558bff;
            margin-bottom: 14px;
        }

        .links-profile-name {
            font-size: 20px;
            font-weight: 700;
            margin: 0 0 4px;
            letter-spacing: 0.3px;
        }

        .links-profile-bio {
            font-size: 13px;
            color: rgba(255,255,255,0.6);
            margin: 0;
        }

        /* Language switcher */
        .links-lang {
            display: flex;
            justify-content: center;
            margin-bottom: 32px;
        }

        .links-lang .dropdown-toggle {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.15);
            color: #fff;
            border-radius: 20px;
            padding: 5px 16px;
            font-size: 13px;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .links-lang .dropdown-toggle:hover,
        .links-lang .dropdown-toggle:focus {
            background: rgba(255,255,255,0.14);
            outline: none;
            box-shadow: none;
        }

        .links-lang .dropdown-menu {
            background: #1a1630;
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 10px;
            min-width: 130px;
        }

        .links-lang .dropdown-item {
            color: rgba(255,255,255,0.8);
            font-size: 13px;
            font-family: 'Poppins', sans-serif;
            padding: 8px 16px;
        }

        .links-lang .dropdown-item:hover,
        .links-lang .dropdown-item.active {
            background: rgba(85,139,255,0.2);
            color: #fff;
        }

        /* Link cards */
        .link-card {
            display: block;
            text-decoration: none;
            border-radius: 14px;
            overflow: hidden;
            margin-bottom: 16px;
            position: relative;
            height: 130px;
            background-color: #1a1630;
            background-size: cover;
            background-position: center;
            transition: transform 0.18s ease, box-shadow 0.18s ease;
        }

        .link-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            text-decoration: none;
        }

        .link-card-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(25, 8, 68, 0.72) 0%, rgba(0, 0, 0, 0.25) 100%);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
        }

        .link-card-name {
            color: #fff;
            font-size: 17px;
            font-weight: 700;
            letter-spacing: 0.2px;
            text-shadow: 0 1px 4px rgba(0,0,0,0.5);
        }

        .link-card-arrow {
            color: rgba(255,255,255,0.85);
            font-size: 18px;
            flex-shrink: 0;
            margin-left: 12px;
        }

        /* Empty state */
        .links-empty {
            text-align: center;
            color: rgba(255,255,255,0.4);
            padding: 48px 0;
            font-size: 14px;
        }

        /* Footer */
        .links-footer {
            text-align: center;
            margin-top: 40px;
        }

        .links-footer a {
            color: rgba(255,255,255,0.35);
            font-size: 12px;
            text-decoration: none;
            transition: color 0.15s;
        }

        .links-footer a:hover {
            color: rgba(255,255,255,0.65);
        }
    </style>
</head>
<body>
    <div class="links-wrapper">
        @yield('content')
    </div>

    <script src="{{ asset('frontend/assets/js/vendor/jquery-min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/lang-switch.js') }}"></script>
</body>
</html>
