<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function create()
    {
        return view('frontend.testimonial-submit');
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

        $feedback = new Feedback();
        $feedback->name = $request->input('name');
        $feedback->role = $request->filled('role') ? $request->input('role') : null;
        $feedback->company = $request->filled('company') ? $request->input('company') : null;
        $feedback->description = '<p>' . e($request->input('description')) . '</p>';
        $feedback->is_active = false;
        $feedback->save();

        return response(['status' => 'success', 'message' => __('ui.testimonial.thank_you')]);
    }
}
