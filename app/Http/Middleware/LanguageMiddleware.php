<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Locales\Language;

class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($locale = session('locale')) {
            app()->setLocale($locale);
        }

        Carbon::setLocale(Language::current()->getCode());

        return $next($request);
    }
}
