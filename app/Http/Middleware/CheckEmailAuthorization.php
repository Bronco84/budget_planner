<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckEmailAuthorization
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->email !== 'bamccoley@gmail.com') {
            abort(403);
        }

        return $next($request);
    }
}
