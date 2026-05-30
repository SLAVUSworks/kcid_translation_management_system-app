<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() || ($request->user()->role !== 'verified' && $request->user()->role !== 'admin')) {
            abort(403, 'Unauthorized. Verified access required.');
        }

        return $next($request);
    }
}
