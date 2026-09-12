<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Feedback;
use App\Models\FeedbackSectionSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TestimonialController extends Controller
{
    public function create()
    {
        $about = Cache::remember('about', 3600, fn() => About::first());
        $feedbackTitle = Cache::remember('feedback_title', 3600, fn() => FeedbackSectionSetting::first());

        return view('frontend.testimonial-submit', compact('about', 'feedbackTitle'));
    }

    public function store(Request $request)
    {
        // Honeypot — bots fill every field, real visitors never see this one.
        if ($request->filled('website')) {
            return response(['status' => 'success', 'message' => __('ui.testimonial.thank_you')]);
        }

        $request->validate([
            'name' => ['required', 'max:50'],
            'role' => ['nullable', 'max:100'],
            'company' => ['nullable', 'max:100'],
            'description' => ['required', 'max:1000'],
            'g-recaptcha-response' => 'required|recaptcha',
        ]);

        // A person's name doesn't change per language — store it identically
        // across all locales instead of only the visitor's current one, so it
        // displays correctly no matter which language the page is viewed in.
        $name = $request->input('name');

        $feedback = new Feedback();
        $feedback->name = ['en' => $name, 'es' => $name, 'pt' => $name];
        $feedback->role = $request->filled('role') ? $request->input('role') : null;
        $feedback->company = $request->filled('company') ? $request->input('company') : null;
        $feedback->description = '<p>' . e($request->input('description')) . '</p>';
        $feedback->is_active = false;
        $feedback->save();

        return response(['status' => 'success', 'message' => __('ui.testimonial.thank_you')]);
    }
}
