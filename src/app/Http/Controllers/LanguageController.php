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

        $cookie = cookie()->forever('locale', $locale);

        if ($request->boolean('ajax')) {
            return response()->noContent()->withCookie($cookie);
        }

        return redirect()->back()->withCookie($cookie);
    }
}
