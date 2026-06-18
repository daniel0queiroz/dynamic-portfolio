<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Lead</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 30px auto; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        .header { background: #4f46e5; color: #fff; padding: 28px 32px; }
        .header h1 { margin: 0; font-size: 20px; }
        .header p { margin: 6px 0 0; font-size: 13px; opacity: 0.8; }
        .body { padding: 28px 32px; }
        .meta { background: #f8f7ff; border-radius: 6px; padding: 14px 18px; margin-bottom: 24px; font-size: 13px; color: #555; }
        .meta span { font-weight: 600; color: #333; }
        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; color: #888; padding: 8px 0 4px; border-bottom: 1px solid #eee; }
        td { padding: 10px 0; border-bottom: 1px solid #f0f0f0; font-size: 14px; vertical-align: top; }
        td.label { color: #555; width: 38%; font-weight: 600; padding-right: 12px; }
        td.value { color: #111; }
        .footer { padding: 16px 32px; background: #fafafa; font-size: 11px; color: #aaa; border-top: 1px solid #eee; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Lead</h1>
            <p>{{ $lead->servicePage->getTranslation('title', 'en', true) }}</p>
        </div>
        <div class="body">
            <div class="meta">
                <div>Submitted at: <span>{{ $lead->created_at->format('d/m/Y H:i') }}</span></div>
                <div>Language: <span>{{ strtoupper($lead->locale) }}</span></div>
                <div>IP: <span>{{ $lead->ip_address }}</span></div>
                <div>LGPD consent: <span>{{ $lead->lgpd_consent ? 'Yes' : 'No' }}</span></div>
            </div>

            <table>
                <thead>
                    <tr><th>Field</th><th>Answer</th></tr>
                </thead>
                <tbody>
                    @foreach ($lead->answers as $answer)
                        <tr>
                            <td class="label">{{ $answer->field?->getTranslation('label', 'en', true) }}</td>
                            <td class="value">
                                @if ($answer->field?->type === 'select')
                                    {{ $answer->field->getOptionLabel($answer->value, 'en') }}
                                @else
                                    {{ $answer->value }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="footer">
            This notification was sent automatically from danqueiroz.com
        </div>
    </div>
</body>
</html>
