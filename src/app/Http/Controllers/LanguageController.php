<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    protected array $supported = ['en', 'es', 'pt'];

    public function switch(Request $request, string $locale)
    {
        if (!in_array($locale, $this->supported)) {
            $locale = 'en';
        }

        return redirect()->back()->withCookie(
            cookie()->forever('locale', $locale)
        );
    }
}
