<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LevelMiddleware
{
    public function handle(Request $request, Closure $next, ...$level)
    {
        if (in_array(Auth::user()?->level, $level)) {
            return $next($request);
        }

        return abort(403);
    }
}
