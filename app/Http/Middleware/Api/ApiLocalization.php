<?php

namespace App\Http\Middleware\Api;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
class ApiLocalization {
    public function handle(Request $request, Closure $next): Response {
        $locale = $request->lang ? $request->lang : 'en';
        app()->setLocale($locale);
        return $next($request);
    }
}