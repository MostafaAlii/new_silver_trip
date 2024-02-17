<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Callcenter;
use Symfony\Component\HttpFoundation\Response;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $callCenter = Callcenter::findOrFail(auth('call-center')->id());
                  
            if ($callCenter->status == "inactive") {
                return response()->json(['message' => 'Call center is inactive'], 403);
            }
            
            return $next($request);

    }
}
