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

        $previous = url()->previous();
        $target = $this->appendLangParam($previous, $locale);

        return redirect()->to($target)->withCookie($cookie);
    }

    private function appendLangParam(string $url, string $locale): string
    {
        $parts = parse_url($url);
        $query = [];
        if (!empty($parts['query'])) {
            parse_str($parts['query'], $query);
        }
        $query['lang'] = $locale;
        $parts['query'] = http_build_query($query);

        $scheme   = $parts['scheme'] ?? null;
        $host     = $parts['host'] ?? null;
        $port     = isset($parts['port']) ? ':' . $parts['port'] : '';
        $user     = $parts['user'] ?? null;
        $pass     = isset($parts['pass']) ? ':' . $parts['pass']  : '';
        $pass     = ($user || $pass) ? "$pass@" : '';
        $path     = $parts['path'] ?? '';
        $queryStr = $parts['query'] ? '?' . $parts['query'] : '';
        $fragment = isset($parts['fragment']) ? '#' . $parts['fragment'] : '';

        return ($scheme ? $scheme . '://' : '') . $user . $pass . ($host ?? '') . $port . $path . $queryStr . $fragment;
    }
}
