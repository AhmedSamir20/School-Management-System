<?php

namespace App\Http\Middleware;

use Closure;

class changeLanguage
{

    public function handle($request, Closure $next)
    {

        app()->setlocale('en');

        if (isset($request->lang)&& $request->lang == 'ar') {
            app()->setLocale('ar');
        }
        return $next($request);
    }
}
