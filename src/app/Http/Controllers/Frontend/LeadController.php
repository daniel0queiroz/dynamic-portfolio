<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\LeadNotificationMail;
use App\Models\Lead;
use App\Models\LeadAnswer;
use App\Models\ServicePage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LeadController extends Controller
{
    public function store(Request $request, string $slug)
    {
        $page = ServicePage::where('slug', $slug)->where('is_active', true)->firstOrFail();

        // Honeypot check
        if ($request->filled('website')) {
            return $this->success($page, $request);
        }

        $fields = $page->leadFormFields;

        // Build validation rules dynamically
        $rules = [
            'lgpd_consent' => ['accepted'],
        ];

        foreach ($fields as $field) {
            $fieldRules = [];
            if ($field->is_required) {
                $fieldRules[] = 'required';
            } else {
                $fieldRules[] = 'nullable';
            }

            match ($field->type) {
                'email'    => $fieldRules[] = 'email',
                'textarea' => $fieldRules[] = 'max:2000',
                default    => $fieldRules[] = 'max:500',
            };

            if ($field->type === 'select') {
                $allowed = array_column($field->getDecodedOptions(), 'value');
                if (count($allowed)) {
                    $fieldRules[] = 'in:' . implode(',', $allowed);
                }
            }

            $rules['field_' . $field->id] = $fieldRules;
        }

        $request->validate($rules);

        $lead = new Lead();
        $lead->service_page_id = $page->id;
        $lead->locale          = app()->getLocale();
        $lead->ip_address      = $request->ip();
        $lead->user_agent      = $request->userAgent();
        $lead->lgpd_consent    = $request->boolean('lgpd_consent');
        $lead->save();

        foreach ($fields as $field) {
            $value = $request->input('field_' . $field->id, '');
            if ($value === '' || $value === null) {
                continue;
            }
            $answer = new LeadAnswer();
            $answer->lead_id  = $lead->id;
            $answer->field_id = $field->id;
            $answer->value    = $value;
            $answer->save();
        }

        // Send email notification (fire-and-forget, don't fail the user if it errors)
        try {
            $lead->load('answers.field', 'servicePage');
            Mail::send(new LeadNotificationMail($lead));
        } catch (\Throwable) {}

        return $this->success($page, $request);
    }

    private function success(ServicePage $page, Request $request)
    {
        $locale     = app()->getLocale();
        $successMsg = $page->getTranslation('form_success_message', $locale, true)
            ?: 'Thank you! I\'ll get back to you soon.';

        if ($request->expectsJson()) {
            return response()->json(['message' => $successMsg]);
        }

        return redirect()
            ->to(url('service/' . $page->slug) . '#lead-form')
            ->with('lead_success', $successMsg);
    }
}
