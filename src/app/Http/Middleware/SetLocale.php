<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    protected array $supported = ['en', 'es', 'pt'];

    public function handle(Request $request, Closure $next)
    {
        $queryLocale = $request->query('lang');
        $locale = $queryLocale;

        if (!$locale || !in_array($locale, $this->supported)) {
            $locale = $request->cookie('locale');
        }

        if (!$locale || !in_array($locale, $this->supported)) {
            $locale = $this->detectFromBrowser($request);
        }

        app()->setLocale($locale);

        $response = $next($request);

        if ($queryLocale && in_array($queryLocale, $this->supported)) {
            $response->withCookie(cookie()->forever('locale', $queryLocale));
        }

        return $response;
    }

    private function detectFromBrowser(Request $request): string
    {
        foreach ($request->getLanguages() as $lang) {
            $code = strtolower(substr($lang, 0, 2));
            if (in_array($code, $this->supported)) {
                return $code;
            }
        }

        return config('app.locale', 'en');
    }
}
